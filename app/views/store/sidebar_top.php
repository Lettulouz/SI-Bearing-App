<div class="offcanvas offcanvas-start bg-light sidebar" data-bs-scroll="true" data-bs-backdrop="false" id="sidebar" aria-labelledby="offcanvasDarkLabel">
    <div class="offcanvas-body pt-1 mt-7 mt-lg-6">
        <nav class="navbar-light">
            <ul class="navbar-nav">
                <li>
                    <a class="btn btn-light btn-lg mt-1" type="button" data-bs-toggle="offcanvas" href=".sidebar" role="button" aria-controls="sidebar">
                        <i class="bi bi-list"></i>
                    </a> 
                </li>
                <li class="my-2 small fw-bold text-uppercase text-decoration-none" value="margin-right:100px">Sortowanie</li>
                <li> 
                    <div class="form-check" style="margin-right:20px;">
                        <select class="form-control" name="sortValue" form='submitFilterSearchSort' style="height:40px;">
                            <option <?php if($data['sortValue']==0 || $data['sortValue']==1) echo "selected"; ?> value="1">Sortuj: od najnowszych</option>
                            <option <?php if($data['sortValue']==2) echo "selected"; ?> value="2">od najstarszych</option>
                            <option <?php if($data['sortValue']==3) echo "selected"; ?> value="3">cena rosnąco</option>
                            <option <?php if($data['sortValue']==4) echo "selected"; ?> value="4">cena malejąco</option>
                        </select>
                    </div>
                </li>
                <li>
                    <hr class="dropdown divider">
                </li>

                
                <li class="my-2 small fw-bold text-uppercase text-decoration-none">Filtry</li>
                <li>
                    <hr class="dropdown divider">
                </li>


 


