<?php
class Messages_model extends CI_Model {
    public function __construct(){
        $this->load->database();
    }
    
    
    public function getMessageId($messages_id,$registeraton_id){
        $this->db->select('messages_id');
        $this->db->from('messages');
        $this->db->where('messages_id', $messages_id); 
        $this->db->where('from_user', $registeraton_id);
        $query = $this->db->get();
        $messages = $query->row();
        return $messages->messages_id;
    }
    
    public function addMessage($message_data){
        $this->db->trans_start();
        $this->db->set($message_data);
        $this->db->insert('messages');
        $message_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $message_id;
    }
    
    public function updateMessage($message_data,$messages_id){
        $this->db->trans_start();
        $this->db->where('messages_id', $messages_id);
        $this->db->update('messages',$message_data);
        $this->db->trans_complete();
        return true;
    }
    
    public function deleteMessage($messages_id,$registeration_id){
        $this->db->delete('messages', array('messages_id' => $messages_id)); 
        $this->db->delete('thread', array('messages_id' => $messages_id)); 
        return true;
    }

    public function addThread($thread_data){
        $this->db->trans_start();
        $this->db->set($thread_data);
        $this->db->insert('thread');
        $thread_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $thread_id;
    }

    public function userTypeById($registeraton_id){
        $this->db->select('r.usertype');
        $this->db->from('registration r');
        $this->db->where('r.registration_id', $registeraton_id); 
        $query = $this->db->get();
        $usertype = $query->row();
        return $usertype->usertype;
    }
    
    public function usersByUserType($registeraton_id,$usertype){
        $this->db->select('registration_id');
        $this->db->select('CONCAT(first_name , " ", last_name) AS name', FALSE);
        $this->db->select('registration_id');
        $this->db->from('registration');
        $this->db->where('usertype', $usertype); 
        $this->db->where('registration_id != ', $registeraton_id); 
        $query = $this->db->get();
        if($query->num_rows()>0){
            $retrieved = $query->result_array();
            return $retrieved;
        }else{
            return FALSE;  
        }
    }
    
    public function getUserSubjectById($registeraton_id){
        $this->db->select('*');
        $this->db->from('messages m');
        $this->db->join('thread t', 't.messages_id = m.messages_id','left');
        $this->db->join('registration r', 'r.registration_id = m.from_user','left');
        $this->db->where('m.to_user = "'. $registeraton_id.'" OR t.from_user = "'. $registeraton_id.'" '); 
        $this->db->_protect_identifiers = FALSE;
        $this ->db->order_by("FIELD( 'r.usertype', 'admin', 'sub_admin', 'account_managers', 'auto_brand', 'dealership' ) ");
        $this->db->_protect_identifiers = TRUE;
        $this ->db->order_by("m.message_read",'desc');
        $this ->db->order_by("m.time",'desc');
        $this ->db->group_by("m.messages_id");
        $query = $this->db->get();
        if($query->num_rows()>0){
            $retrieved = $query->result_array();
            return $retrieved;
        }else{
            return FALSE;  
        }
    }
    
    public function getLatestMessageId($registeration_id){
        $this->db->select('m.messages_id');
        $this->db->from('messages m');
        $this->db->join('thread t', 't.messages_id = m.messages_id','left');
        $this->db->join('registration r', 'r.registration_id = m.from_user','left');
        $this->db->where('m.to_user = "'. $registeration_id.'" OR t.from_user = "'. $registeration_id.'" '); 
        $this->db->order_by("m.messages_id",'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $message = $query->row();
        if($message){
            return $message->messages_id;
        }
    }
    
    public function countMessageId($registeration_id){
        $this->db->select('m.messages_id');
        $this->db->from('messages m');
        $this->db->join('thread t', 't.messages_id = m.messages_id','left');
        $this->db->join('registration r', 'r.registration_id = m.from_user','left');
        $this->db->where('m.to_user = "'. $registeration_id.'" OR t.from_user = "'. $registeration_id.'" '); 
        $this->db->order_by("m.messages_id",'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $message = $query->row();
        if($message){
            return $message->messages_id;
        }
    }
    
    public function getMessageBySubjectId($registeration_id,$subject_id){
        $this->db->select('*');
        $this->db->from('messages m');
        $this->db->join('thread t', 't.messages_id = m.messages_id','left');
        $this->db->join('registration r', 'r.registration_id = m.from_user','left');
        $this->db->where('m.to_user = "'. $registeration_id.'" OR t.from_user = "'. $registeration_id.'" '); 
        $this->db->where('m.messages_id', $subject_id); 
        $this->db->order_by("m.time",'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $latest_messages = $query->row();
        return $latest_messages;
    }
    
    public function loadMessageBySubjectId($registeration_id,$subject_id){
        $this->db->select('*');
        $this->db->from('messages m');
        $this->db->join('registration r', 'r.registration_id = m.from_user','left');
        $this->db->where('m.messages_id', $subject_id); 
        $this->db->order_by("m.time",'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $latest_messages = $query->row();
        return $latest_messages;
    }
    
    public function getThreadBySubjectId($subject_id){
        $this->db->select('*');
        $this->db->from('thread t');
        $this->db->join('messages m', 'm.messages_id = t.messages_id','left');
        $this->db->where('t.messages_id', $subject_id);
        $this->db->order_by("t.thread_id",'desc');
        $query = $this->db->get();
        if($query->num_rows()>0){
            $retrieved = $query->result_array();
            return $retrieved;
        }else{
            return FALSE;  
        }
    }
}
?>

