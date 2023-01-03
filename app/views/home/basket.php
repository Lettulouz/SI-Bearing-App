<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>
<div class="homeMain">
    <div class="container-fluid my-4">
        <div class="row d-flex justify-content-center">
            <aside class="col-lg-6">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col" width="300">Product</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="120">Price</th>
                                    <th scope="col" class="text-right d-none d-md-block" width="120"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <figure class="itemside align-items-center">
                                            <div class="aside"><img src="https://i.imgur.com/1eq5kmC.png" class="img-sm"></div>
                                            <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">Tshirt with round nect</a>
                                                <p class="text-muted small">SIZE: L <br> Brand: MAXTRA</p>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td> <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select> </td>
                                    <td>
                                        <div class="price-wrap"> <var class="price">$10.00</var> <small class="text-muted"> $9.20 each </small> </div>
                                    </td>
                                    <td class="text-right d-none d-md-block"><a href="" class="btn btn-light btn-round" data-abc="true"> Remove</a> </td>
                                </tr>
                                <tr>
                                    <td>
                                        <figure class="itemside align-items-center">
                                            <div class="aside"><img src="https://i.imgur.com/hqiAldf.jpg" class="img-sm"></div>
                                            <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">Flower Formal T-shirt</a>
                                                <p class="text-muted small">SIZE: L <br> Brand: ADDA </p>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td> <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select> </td>
                                    <td>
                                        <div class="price-wrap"> <var class="price">$15</var> <small class="text-muted"> $12 each </small> </div>
                                    </td>
                                    <td class="text-right d-none d-md-block"><a href="" class="btn btn-light btn-round" data-abc="true"> Remove</a> </td>
                                </tr>
                                <tr>
                                    <td>
                                        <figure class="itemside align-items-center">
                                            <div class="aside"><img src="https://i.imgur.com/UwvU0cT.jpg" class="img-sm"></div>
                                            <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">Printed White Tshirt</a>
                                                <p class="small text-muted">SIZE:M <br> Brand: Cantabil</p>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td> <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select> </td>
                                    <td>
                                        <div class="price-wrap"> <var class="price">$9</var> <small class="text-muted"> $6 each</small> </div>
                                    </td>
                                    <td class="text-right d-none d-md-block"><a href="" class="btn btn-light btn-round" data-abc="true"> Remove</a> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </aside>
            <aside class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right text-dark b ml-3"><strong>$59.97</strong></dd>
                        </dl>
                        <hr> <a href="#" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Make Purchase </a> <a href="#" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>