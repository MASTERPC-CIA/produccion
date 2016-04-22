
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <?php
            echo $this->load->view('login/user_logo', '', TRUE);
            ?>
        </div>

        <ul class="sidebar-menu">   
            <!--Produccion-->
            <li class="header">PRODUCCION</li>
            <li> <a class="active" href="<?= base_url('produccion/index/') ?>"><i class="glyphicon glyphicon-pencil"></i> Consolidado Mensual</a> </li>
            <li> <a class="active" href="<?= base_url('produccion/index/') ?>"><i class="glyphicon glyphicon-list"></i> Reportes Consolidado</a> </li>

            <br class="clr"/>    
            <?php
            if (!empty($slidebar_actions)) {
                echo $slidebar_actions;
            }
            ?>
    </section>
    <!-- /.sidebar -->
</aside>

<style type="text/css">
    /*CON ESTE ESTILO ESTOY SOBREPONIENDOME A LOS QUE VAN POR DEFECTO EN LSO BOTONES DE SUBMIT CON LA PALABRA IMPORTANT*/ 
    ul.sidebar-menu #ajaxformbtn{
        background-color: /*#fff */rgba(0,0,0,0)!important; 
        padding: 0.9em 9em 0.9em 1em ;
        background-image: none !important;
        /*opacity: 0.3 !important;*/
    }
    ul.sidebar-menu #ajaxformbtn:hover{
        background-color: #eee !important;
        color: #3B5998 !important;
    }
</style>