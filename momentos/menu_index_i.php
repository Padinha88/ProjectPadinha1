<header>

<!-- Logo da empresa -->
<div id="cabeca">
    <div class="Logo_Principal">
        <a href="index_i.php">
        <img width="100%" src="img/momentos.svg">
        </a>
    </div>

    <div id="Menu">
        <nav> 
            <ul>
                <li><a href="#">BIKES <span class="seta">▲</span> </a>             
                    <ul>
                        <li><a href= "bicicleta.php?b=1">JOËLETTE ADVENTURE</a></li>
                        <li><a href= "bicicleta.php?b=2">JOËLETTE EMOTION</a></li>
                        <li><a href= "bicicleta.php?b=3">JOËLETTE FINISHER</a></li>
                        <li><a href= "bicicleta.php?b=4">JOËLETTE KIDS</a></li>
                        <li><a href= "bicicleta.php?b=5">JOËLETTE SOFAO</a></li>
                        <li><a href= "bicicleta.php?b=6">VANRAAM WHELLCHAIR</a></li>
                        <li><a href= "bicicleta.php?b=7">VANRAAM VELOPLUS</a></li>
                        <li><a href= "bicicleta.php?b=8">VANRAAM EASY GO</a></li>
                    </ul>               
                </li>
                <li><a href="parque_i.php?b=1">INCLUSIVE PARKS</a></li>
                <li><a href="sobre_nos_i.php?b=1">ABOUT US</a></li>

                <!-- Login e Logout-->
                <li><a href=" 
                    <?php if (!isset($_SESSION['username'])) {
                        echo 'login.php?b=1';
                    } else {
                        echo 'logout.php';
                    }
                    ?>
                    ">
                <?php  
                if (!isset($_SESSION['username'])) {
                echo 'LOGIN';
                } else {
                    echo 'LOGOUT';
                }
                ?>
            
            </a></li>

                <li><a href="loja2.php?b=1">🛒</a></li>

                <li><a href="#">🌐</a>
                    <ul>
                        <li><a href="index.php">PT</a></li>
                        <li><a href="index_i.php">GB</a></li>
                        <li><a href="index_e.php">ES</a></li>
                    </ul>
                </li>     
            </ul> 
        </nav>
    </div>
</div>

</header>