<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/metisMenu.min.css')!!}
    {!!Html::style('css/sb-admin-2.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
</head>

<body>
                        <?php
                            $rol = Auth::user()->rol_Id
                        ?>
    <div id="wrapper">

        
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Administrador Oansa</a>
            </div>
           

            <ul class="nav navbar-top-links navbar-right">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        {!! Auth::user()->nombre !!}
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Ajustes</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{!!URL::to('/logout')!!}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{!!URL::to('/lider/'.Auth::user()->cedula.'/edit')!!}"><i class="fa fa-sign-out fa-fw"></i> Editar perfil</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                   
                        <li>
                            <a href="#"><i class="fa fa-smile-o"></i> Oansista<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!!URL::to('/oansista/create')!!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                <li>
                                    <a href="{!!URL::to('/oansista')!!}"><i class='fa fa-list-ol fa-fw'></i> Listado</a>
                                </li>
                            </ul>
                        </li>
                      
                        @if($rol == 1)
                        <li>
                            <a href="#"><i class="fa fa-child fa-fw"></i> Lider<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL::to('/lider/create') !!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                <li>
                                    <a href="{!! URL::to('/lider') !!}"><i class='fa fa-list-ol fa-fw'></i> Listado</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                        

                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Area<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!!URL::to('/area/create')!!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                <li>
                                    <a href="{!!URL::to('/area')!!}"><i class='fa fa-list-ol fa-fw'></i> Listado</a>
                                </li>
                            </ul>
                        </li>
                     @if(Auth::user()->rol_id == 1)       
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Administraión de roles<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!!URL::to('/rol/create')!!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                <li>
                                    <a href="{!!URL::to('/rol')!!}"><i class='fa fa-list-ol fa-fw'></i> Listado</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Manuales<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!!URL::to('/manual')!!}"><i class='fa fa-plus fa-fw'></i> Asignar un manual</a>
                                </li>
                                <li>
                                    <a href="{!!URL::to('/manual/aprobar')!!}"><i class='fa fa-list-ol fa-fw'></i> Aprobar Secciones</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-tasks"></i> Reportes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"><i class='fa fa-newspaper-o'></i> Reporte Semanal Lider</a>
                                </li>

                                <li>
                                    <a href="#"><i class='fa fa-newspaper-o'></i> Informe Semanal Club</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>

     </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>

    </div>
    

    {!!Html::script('js/jquery.min.js')!!}
    {!!Html::script('js/script.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}
    {!!Html::script('js/metisMenu.min.js')!!}
    {!!Html::script('js/sb-admin-2.js')!!}

</body>

</html>
