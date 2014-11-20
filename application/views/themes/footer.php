</div>
</body>
    <div style="height: 53px;">&nbsp;</div>
    <div style="float: left; width: 100%;position: fixed;bottom:0;">
    <style>
    .footer-class{
         background: -moz-linear-gradient(center top , #5E5E5E, #4F4F4F 4%, #262626 44%, #1C1C1C 50%, #050505 50%, #000000) repeat scroll 0 0 rgba(0, 0, 0, 0);
        height: 55px;
        width: 100%;
        background-color: #4F4F4F;
        bottom: 0;
     float: left;
      position: absolute;
      margin-top: 0px;

    }
    .copyright-text{
    color: #FFFFFF;
    float: right;
    font-size: 11px;
    margin-right: 547px;
    margin-top: 15px;
    }
    .glow:before, #footer-id:before {
    background: url("../images/effects/glow.png") no-repeat scroll center center / 100% 100% rgba(0, 0, 0, 0);
    bottom: 0;
    content: " ";
    display: block;
    left: 0;
    pointer-events: none;

    right: 0;
    top: 0;
    }
    .privacypolicy{
        float: left;
        font-size: 11px;
        padding-top: 4px;
        text-align: center;
        width: 94%;
    }
    .privacypolicy a{
        color: #FFFFFF;
    }
    </style>
        <div class="footer-class" id="footer-id">
        <?php
        if(isset($menu['logged_in']['usertype']) && $menu['logged_in']['usertype']=='dealership'){
         ?>
            <span class="privacypolicy"><a href="#" style="text-decoration: none;">Privacy Policy</a></span>
        <?php
            $copy_text="margin-top: 8px;";
        }
        else{
            $copy_text="";
        }
        ?>
        <span class="copyright-text" style="<?=$copy_text?>">All rights reserved by Exclusive Private Sale.Inc. Copyright 2013-2014</span>

        </div>
  </div>
  </html>
