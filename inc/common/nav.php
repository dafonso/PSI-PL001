<<<<<<< HEAD
<ul class="nav nav-pills pull-left">
	<li><a href="index.php">Home</a></li>
</ul>
<ul class="nav nav-pills pull-right">
	<?php if (!$userLoggedIn) { ?>
	<li><a href="registo.php">Registo</a>
	</li>
	<li><a href="login.php">Login</a>
	</li>
	<?php } else { ?>
	<ul class="nav nav-pills pull-right">
		<li><a href="consultarPerfil.php">Olá <?=$_SESSION['user_name'];?>
		</a></li>
		<li><a href="historicoCompras.php">Consultar Compras</a>
		</li>
		<li><a href="?logout=1">Logout</a>
		</li>
	</ul>
	<?php } ?>
</ul>
=======
<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav pull-left">
            <li><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav pull-right">
            <?php if (!$userLoggedIn) { ?>
                <li><a href="registo.php">Registo</a>
                </li>
                <li><a href="login.php">Login</a>
                </li>
            <?php } else { ?>
                <ul class="nav pull-right">
                    <li><a href="consultarPerfil.php">Olá <?= $_SESSION['user_name']; ?>
                        </a></li>
                    <li><a href="historicoCompras.php">Consultar Compras</a>
                    </li>
                    <li><a href="?logout=1">Logout</a>
                    </li>
                </ul>
            <?php } ?>
        </ul>
    </div>
</div>
>>>>>>> 3c77929c1fd16b92d65fcec8f77e80dce60a01ef
