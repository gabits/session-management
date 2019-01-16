<?php
// Main page of the website.

include 'includes/header.php';
include 'forms/logout.php';

?>

<article class="home-intro">

    <div class="pure-g-gutter message">
        <p>The Department of Computer Science and Information Systems at Birkbeck is one of the first computing departments established in the UK, celebrating our 60th anniversary in 2017. We provide a stimulating teaching and research environment
            for both part-time and full-time students, and a friendly, inclusive space for learning, working and collaborating.</p>
    </div>

</article>

<div class="pure-g home-panels">

    <div class="pure-u-1 pure-u-sm-1-2 pure-u-md-1-2 pure-u-lg-1-3 item">

        <section class="links">
            <h4>
                <a href='intranet.php'>Intranet</a> |
                <a href='administrator.php'>Administrator</a>
            </h4>
        </section>

        <section class="panel panel-listing">
            <header class="panel-header">
                <h2><a href="http://www.dcs.bbk.ac.uk/news/"><i class="dcs-icon dcs-icon-newspaper"></i> News &amp; Events</a></h2>
            </header>
            <div class="panel-content cpy">

                <div class="fake-table listing">

                    <article class="item first">
                        <h3><a href="http://www.dcs.bbk.ac.uk/news/virtual-world-tour-on-the-future-of-work/">Virtual World Tour on the Future of Work</a></h3>
                        <p class="tagline">Posted: Wednesday, 5 December 2018 16:00</p>
                    </article>

                    <article class="item">
                        <h3><a href="http://www.dcs.bbk.ac.uk/news/s-repls-10/">10th South of England Regional Programming Language Seminar</a></h3>
                        <p class="tagline">Posted: Thursday, 23 August 2018 08:00</p>
                    </article>

                    <article class="item last">
                        <h3><a href="http://www.dcs.bbk.ac.uk/news/chi-index-measure/">Computer Scientists devise new measure for research impact</a></h3>
                        <p class="tagline">Posted: Wednesday, 11 July 2018 11:00</p>
                    </article>

                </div>
            </div>
        </section>
    </div>
</div>


<?php include 'includes/footer.php'; ?>
