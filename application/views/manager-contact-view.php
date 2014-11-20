<style>
.main-fancydiv{
    border: 5px solid black;
    height: 53%;
    padding: 15px;
    background-color: white;
}
.label_name{
    width:35%;
    float:left;
    color: #808080;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    font-weight:bold;
}
.label_ans{
    color: #808080;
}

</style>
<div class="main-fancydiv">
    <?php
    if(isset($get_managerdetails) || $get_managerdetails!=''){        
    ?>
    <h2><?=$get_managerdetails[0]['first_name'].' '.$get_managerdetails[0]['last_name']?> Contact Details</h2>
    <div>
        <label class="label_name">First Name</label>
        <span class="label_ans"><?=$get_managerdetails[0]['first_name']?></span><br />
        <label class="label_name">Last Name</label>
        <span class="label_ans"><?=$get_managerdetails[0]['last_name']?></span><br />
        <label class="label_name">Contact Email</label>
        <span class="label_ans"><a style="text-decoration: none;" href="mailto:<?=$get_managerdetails[0]['email_id']?>"><?=$get_managerdetails[0]['email_id']?></a></span><br />
        <label class="label_name">Contact Phone </label>
        <span class="label_ans"><?=$get_managerdetails[0]['contact_phone_number']?></span><br />
    </div>
    <?php
    }
    ?>
</div>