<!-- Footer -->
<footer class="text-center container-fluid text-lg-start bg-light mt-auto text-muted mb-0 px-0" >

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto py-3">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-3">
            <?=$data['siteFooter']['name']?>
          </h6>
          <p>
            <?=$data['siteFooter']['brief']?>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto py-3">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-3">
              <?=$data['siteFooter']['c1name']?>
          </h6>
          <p>
            <a href="<?=$data['siteFooter']['c1r1path']?>" class="text-reset"><?=$data['siteFooter']['c1r1']?></a>
          </p>
          <p>
            <a href="<?=$data['siteFooter']['c1r2path']?>" class="text-reset"><?=$data['siteFooter']['c1r2']?></a>
          </p>
          <p>
            <a href="<?=$data['siteFooter']['c1r3path']?>" class="text-reset"><?=$data['siteFooter']['c1r3']?></a>
          </p>
          <p>
            <a href="<?=$data['siteFooter']['c1r4path']?>" class="text-reset"><?=$data['siteFooter']['c1r4']?></a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto py-3">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-3">
              <?=$data['siteFooter']['c2name']?>
          </h6>
          <p>
            <a href="<?=$data['siteFooter']['c2r1path']?>" class="text-reset"><?=$data['siteFooter']['c2r1']?></a>
          </p>
          <p>
            <a href="<?=$data['siteFooter']['c2r2path']?>" class="text-reset"><?=$data['siteFooter']['c2r2']?></a>
          </p>
          <p>
            <a href="<?=$data['siteFooter']['c2r3path']?>" class="text-reset"><?=$data['siteFooter']['c2r3']?></a>
          </p>
          <p>
            <a href="<?=$data['siteFooter']['c2r4path']?>" class="text-reset"><?=$data['siteFooter']['c2r4']?></a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto py-3 mb-md-0">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-3"><?=$data['siteFooter']['c3name']?></h6>
          <p> <?=$data['siteFooter']['c3r1']?></p>
          <p> <?=$data['siteFooter']['c3r2']?></p>
          <p> <?=$data['siteFooter']['c3r3']?></p>
          <p> <?=$data['siteFooter']['c3r4']?></p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    <a class="text-reset fw-bold" href="<?=$data['siteFooter']['bottomtextpath']?>"><?=$data['siteFooter']['bottomtext']?></a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

</body>
</html>
