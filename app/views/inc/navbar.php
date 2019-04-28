<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
                </li>
                <?php if (Session::get('SignedIn')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>game/">Game</a>
                    </li>                
                <?php endif ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>index/about">About</a>
                </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Errors
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (DEBUG): ?>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>Errors">Display Error</a>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>Errors/Test">Test Error</a>
                            <?php endif ?>  
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>Errors/Report">Report Error</a>
                        </div>
                    </li>
                <?php if (DEBUG): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Debug
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>Debug">Index</a>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>Debug/DatabaseTester">Database Tester</a>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>Debug/BrokenSQL">Submit Broken SQL</a>
                        </div>
                    </li>
                <?php endif ?>     
            </ul>
            <?php if (!Session::get('SignedIn')): ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>users/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>users/register">Register</a>
                    </li>          
                </ul>
            <?php else: ?> 
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>users/logout">Log Out</a>
                    </li>        
                </ul>           
            <?php endif ?>  
        </div>
    </div>
</nav>