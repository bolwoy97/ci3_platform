
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">
                Copyright © 2020 Grid Yard
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
</div>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<? $this->load->view('layouts/scripts'); ?>

<script>
    const copyToClipboard = str => {
  const el = document.createElement('textarea');
  el.value = str;
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
};
</script>

<!--
<a style='
-webkit-font-smoothing: antialiased;
-webkit-tap-highlight-color: transparent;
font-feature-settings: "liga" 0;
box-sizing: border-box;
text-decoration: none;
background-color: transparent;
position: fixed;
bottom: 20px;
right: 100px;
text-align: center;
z-index: 10000;
height: 50px;
width: 200px;
background-repeat: no-repeat;
background-position: center;
-webkit-transition: background-color 0.1s linear;
border-radius: 3px;
background-image: linear-gradient(to right, #006fff   0%, #006fff  100%);
color: #fff;
display: inline;'><?// echo $this->benchmark->memory_usage();?></a>-->
