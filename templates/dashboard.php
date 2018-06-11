        <section id="dashboard">
            <aside id="sidebar" class="r-border" role="complementary">
                <div id="sb-header" class="b-border">
                    <img src="./images/login-avatar.png" alt="" width="60" height="50">
                    <span class="d4"><?= $_SESSION['uid'] ?></span><span class="d4 direction"></span>
                </div>
                <div class="sb-section b-border">
                    <div id="user-details">
                        <ul>
                            <li>
                                <p class="d4 bold">Name:</p>
                                <span class="d4"><?= $_SESSION['fname'] . ' ' .  $_SESSION['lname']?></span>
                            </li> 
                            <li>
                                <p class="d4 bold">Address:</p>
                                <span class="d4"><?= $_SESSION['address'] ?>, </span>
                                <span class="d4"><?= $_SESSION['city'] ?>, </span>
                                <span class="d4"><?= $_SESSION['postcode'] ?>, </span>
                                <span class="d4"><?= $_SESSION['country'] ?></span>
                            </li> 
                            <li>
                                <p class="d4 bold">Account type:</p>
                                <span class="d4"><?= $_SESSION['acc_type'] ?></span>
                            </li>                       
                        </ul>
                    </div>
                    <div class="card">
                        <img src="./images/cc.png" alt="creditcards" width="60" height="38">
                        <p class="d4 bold">Sim C/C Balance:</p>
                        <p class="d4">£
                            <span class="d3" id="balance">
                                <?php
                                    $balance = mysqli_fetch_assoc(mysqli_query($link, "SELECT acc_balance FROM accounts WHERE acc_uid = '".$_SESSION['uid']."'"));
                                    echo $balance['acc_balance'];
                                ?>
                            </span>
                        </p></br>
                    </div>
                </div>
                <div class="sb-section">
                    <div class="d3 errormsg"><?= $_SESSION['message'] ?></div>
                    <form method="post" id="deposit-form">
                        <div class="form-grp">
                            <input class="r-corners form-control" type="number" step="0.01" name="deposit" placeholder="eg. £250.00">
                            <button class="form-control r-corners btn btn-clr-red f-width" name="submit" type="submit" role="button">Deposit</button>
                        </div>
                    </form>
                    <form method="post" id="withdrawl-form">
                        <div class="form-grp">
                            <input class="r-corners form-control" type="number" step="0.01" name="withdraw" placeholder="eg. £250.00">
                            <button class="form-control r-corners btn btn-clr-blue f-width" name="submit" type="submit" role="button">Withdraw</button>
                        </div>
                    </form>
                </div>
            </aside>
            <section id="dash-main">
                <div id="dash-header" class="b-border">
                    <div>
                        <h1 class="d2">Dashboard<h1>
                    </div>
                    <div>
                        <p class="d5 muted">Currencies updated daily at 12:00:00 GMT</p>
                    </div>
                </div>  
                <div id="dash-content">
                    <div id="deck" role="complementary">
                        <div class="card-grp">
                            <div class="card r-border">
                                <div class="card-header">
                                    <img src="./images/png_flags/european-union.png" alt="euro flag" width="30" height="30">
                                    <p class="d4">Euro - EUR</p>
                                </div>
                                <div class="card-content d0">
                                    <p>€<span class="d2"><?= $_SESSION['eur'] ?></span></p>
                                </div>
                            </div>
                            <div class="card r-border">
                                <div class="card-header">
                                    <img src="./images/png_flags/india.png" alt="indian flag" width="30" height="30">
                                    <p class="d4">Indian Rupee - INR</p>
                                </div>
                                <div class="card-content d0">
                                    <p>&#x20b9;<span class="d2"><?= $_SESSION['inr'] ?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-grp">
                            <div class="card r-border">
                                <div class="card-header">
                                    <img src="./images/png_flags/mauritius.png" alt="mauritian flag" width="30" height="30">
                                    <p class="d4">Mauritian Rupee - MUR</p>
                                </div>
                                <div class="card-content d0">
                                    <p>Rs<span class="d2"><?= $_SESSION['mur'] ?></span></p>
                                </div>
                            </div>
                            <div class="card r-border">
                                <div class="card-header">
                                    <img src="./images/png_flags/philippines.png" alt="philipino flag" width="30" height="30">
                                    <p class="d4">Philippine Peso - PHP</p>
                                </div>
                                <div class="card-content d0">
                                    <p>₱<span class="d2"><?= $_SESSION['php'] ?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-grp">
                            <div class="card r-border">
                                <div class="card-header">
                                    <img src="./images/png_flags/croatia.png" alt="croatian flag" width="30" height="30">
                                    <p class="d4">Croatian Kuna - HRK</p>
                                </div>
                                <div class="card-content d0">
                                    <p>kn<span class="d2"><?= $_SESSION['hrk'] ?></span></p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <img src="./images/png_flags/south-africa.png" alt="south african flag" width="30" height="30">
                                    <p class="d4">South African Rand - ZAR</p>
                                </div>
                                <div class="card-content d0">
                                    <p>R<span class="d2"><?= $_SESSION['zar'] ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dash-main-container">
                        <div class="dash-module" role="complementary">
                             <!--<div class="dash-module-header b-border">
                                <h2 class="d3">Transaction Summary</h2>
                            </div>-->
                            <div class="dash-module-container">
                                
                            <form id="quotes-mod" method="POST" role="form">
                                
                                <div id="quote">
                                    <div id="send">
                                        <div class="form-grp">
                                            <p class="d3 muted">You buy GBP</p>
                                            <input class="form-control d3" id="amount" type="number" step="0.01" name="amount" value=100> 
                                        </div> 
                                        <div class="form-grp">
                                            <p class="d3 muted">in</p>
                                            <input class="form-control d3" id="curr-select" type="text" name="curr-select" value="Australian Dollar"> 
                                            <div id="response"></div>
                                        </div> 
                                    </div>
                                    <div id="send">
                                        <div class="form-grp">
                                            <p class="d3 muted">from</p>
                                            <select class="form-control d3" id="src-uid-select" name="src-uid-select">
                                                <option selected>Frontier</option>
                                            </select> 
                                        </div> 
                                        <div class="form-grp">
                                            <p class="d3 muted">and send to</p>
                                            <select class="form-control d3" id="dest-uid-select" name="dest-uid-select">
                                                <option value="Find user">Find user</option>
                                            </select> 
                                        </div> 
                                    </div>
                                    <div id="get">
                                        <div id="get-header">
                                            <div><p class="d4 muted">They Recieve</p></div>
                                            <div><p class="d4 muted">+£<span id="quote-fees"></span>p in fees</p></div>
                                        </div>
                                        <div id="get-display">
                                            <div><p class="d2" id="quote-amount"></p><span class="d3" id="quote-curr-code"></span></div>
                                            <!--<p class="d4 muted" id="quote-deduction">£<span id="deduction-amount">123</span> deducted</p>-->
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                </div>
                                <button class="btn e-corners f-width btn-clr-green" id="send-btn" type="submit" role="button">Send money now</button>
                            </form>

                            </div>
                        </div>
                        <div class="dash-module">
                            <div class="dash-module-container">
                                [+exch_mod+]
                            </div>
                        </div>
                        <div class="dash-module">
                            <div class="dash-module-header b-border">
                                <h2 class="d3">Latest Rates for Pound Sterling (£GBP)</h2>
                            </div>
                            <div class="dash-module-container">
                                <div id="rates-table">
                                    [+rates_table+]
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        
        
                            
                            
                            
                            