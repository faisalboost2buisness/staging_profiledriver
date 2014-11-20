	<!-- JavaScript at the bottom for fast page loading -->
	<!-- Scripts -->

    <link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
    <!-- Button to open/hide menu -->
	<a href="#" id="open-menu"><span>Menu</span></a>
	<!-- Button to open/hide shortcuts -->
	<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
    <style>
    .button{
       width: 187px; 
       font-size:17px;
    }
    .button-height{
           float: left;
    margin-top: 55px;
    width: 237px;
    }
    .footer-class{
        position: absolute;
        }
    </style>
    
	<!-- Main content -->
	<section role="main" id="main">
		<hgroup id="main-title" class="thin" style="text-align: left;">
        	<h1>Create Membership</h1>
		</hgroup>
        <div style="margin: 0 auto; width:723px">
            <?php
            $value='dealer';
            ?>
                <p class="button-height">
                <a href="<?=base_url()?>register/index/<?=$value?>" class="button green-gradient">Dealer</a>
                </p>
             <?php
            $value1='account_managers';
            ?>
                <p class="button-height">
                <a href="<?=base_url()?>register/index/<?=$value1?>" class="button green-gradient">Accounts Manager </a>
                </p>
             <?php
            $value2='auto_brand';
            ?>
                <p class="button-height">
                <a href="<?=base_url()?>register/index/<?=$value2?>" class="button green-gradient">Auto Brand</a>
                </p>
        </div>
        </section>
        