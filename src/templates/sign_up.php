        <section id="sign-up">
            <div id="sign-up-grp">
                <div class="page-header">
                    <h1 class="d2">Registration</h1>
                    <div class="d3 errormsg"><?= $_SESSION['message'] ?></div>
                </div>
                <form id="reg-form" action="" method="POST">      
                    
                     <div class="form-grp-row">
                        <div class="form-grp">
                            <label for="email">Email <span class="d5 errormsg"></span></label> </br>
                            <input class="r-corners form-control f-width" type="email" name="email" placeholder="eg. user@abc123.com" autofocus="">    
                        </div> 
                        <div class="form-grp">
                            <label for="postcode">username <span class="d5 errormsg"></span></label> </br>
                            <input class="r-corners form-control f-width" type="text" name="username" placeholder="ajax123"> 
                        </div>
                    </div>
                    <div class="form-grp-row">
                        <div class="form-grp">
                            <label for="email">Password <span class="d5 errormsg"></span></label><span></span> </br>
                            <input class="r-corners form-control f-width" id="pwd" type="password" name="pwd"> 
                        </div> 
                        <div class="form-grp">
                            <label for="postcode">Confirm Password <span class="d5 errormsg"></span></label> </br>
                            <input class="r-corners form-control f-width" type="password" name="confirm_pwd"> 
                        </div>
                    </div>
                    <div class="form-grp-row">
                        <div class="form-grp">
                            <label for="title">Acc. Type</label> </br>
                            <select class="r-corners form-control f-width" name="acc_type">
                                <option>Personal</option>
                                <option>Business</option>
                            </select> 
                        </div>
                        <div class="form-grp">
                            <label for="fName">First name <span class="d5 errormsg"></span></label> </br>
                            <input class="r-corners form-control f-width" type="text" name="fName"> 
                        </div>
                        <div class="form-grp">
                            <label for="lName">Last name <span class="d5 errormsg"></span></label> </br>
                            <input class="r-corners form-control f-width" type="text" name="lName">    
                        </div>
                    </div>
                    <div class="form-grp">
                            <label for="email">Address <span class="d5 errormsg"></span></label> </br>
                            <input class="r-corners form-control f-width" type="text" name="address" placeholder="eg. Flat 1A Colgate Avenue">    
                    </div>
                    <div class="form-grp-row">
                        <div class="form-grp">
                            <label for="city">City <span class="d5 errormsg"></span></label> </br>
                            <input class="r-corners form-control f-width" type="text" name="city" placeholder="eg. London" value=""> 
                        </div>
                        <div class="form-grp">
                            <label for="postcode">Post/Zipcode <span class="d5 errormsg"></span></label> </br>
                            <input class="r-corners form-control f-width" type="text" name="postcode" placeholder="eg. WC1E 7HX" value=""> 
                        </div>
                        <div class="form-grp">
                            <label for="country">Country</label> </br>
                            <select class="r-corners form-control f-width" name="country">
                                <option>United Kingdom</option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-grp">
                        <button class="r-corners btn f-width btn-clr-blue" type="submit">Submit</button>
                    </div>              
                </form>
            </div>
        </section>