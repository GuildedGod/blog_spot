<!DOCTYPE html>
<!-- saved from url=(0053)http://twitter.github.io/bootstrap/examples/hero.html -->

<body>

<div class="container">

    <div class="hero-unit">
        <h1 class="align-content-center">Cake Blog</h1>
        <p><br>Welcome to the Defyne Blog Spot.  The portal is currently under construction.</p>

        <p>When the portal is ready to received post.  If you have questions regarding the portal or desire to share feedback related to this site, please do not hesitate to contact me at <a href="mailto:carlton.alvin.henry@gmail.com">carlton.alvin.henry@gmail.com</a></p>

        <p>All the best,</p>

        <p>Carlton A. Henry</p>
        <p>
            <?= $this->Html->Link(__('Public Blogs'), ['action' => '../Blog/pleb'],['class' => 'btn btn-large btn-primary']) ?>
            <?= $this->Html->Link(__('Private Repository'), ['action' => '../Blog/index'],['class' => 'btn btn-large btn-primary']) ?>
            <?= $this->Html->Link(__('Login'), ['action' => '../Users/login'],['class' => 'btn btn-large btn-primary']) ?>
            <?= $this->Html->Link(__('Register'), ['action' => '../Users/register'],['class' => 'btn btn-large btn-primary']) ?>
        </p>
    </div>
    <hr>

</div> <!-- /container -->


</body></html>
