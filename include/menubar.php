<nav class="navbar navbar-expand-lg navbar-light"
     style="position: fixed; z-index: 2; right: 2px; left: 2px; top: 2px; padding: 10px; background: #e3f2fd; border: 0px solid #333;">


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../../..">Головна <span class="sr-only">(current)</span></a>
            </li>
            <li>
<!--                <a class="nav-link" href="{% url 'importasc' %}">Імпорт <span class="sr-only">(current)</span></a>-->
            </li>

        </ul>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo $_SESSION['username']  . '&nbsp;&nbsp;';
            echo '<a href="../logout.php">Вийти</a>' . '&nbsp;&nbsp;';
        } else {
            echo '<a href="../login.php">Увійти</a>' . '&nbsp;&nbsp;';
        }

        ?>
        &nbsp;&nbsp;&nbsp;
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
