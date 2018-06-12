       
       <form class="form-login box" id="userLogin" action="" method="POST" role="form">
            <div class="page-header">
                <h1 class="d2">Client login</h1>
                <div class="d3 errormsg"><?= $_SESSION['message'] ?></div>
            </div>
            <input class="form-control r-corners f-width" type="text" name="username" placeholder="username" autofocus="">
            <input class="form-control r-corners f-width" type="password" name="pwd" placeholder="password">
            <button class="btn r-corners f-width btn-clr-red" type="submit" role="button">Submit</button>
        </form>
