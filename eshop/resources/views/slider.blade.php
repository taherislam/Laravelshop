
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                            <li data-target="#slider-carousel" data-slide-to="3"></li>
                            <li data-target="#slider-carousel" data-slide-to="5"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                <?php
                   $all_publication_slider=DB::table('tbl_slider')
                                            ->where('publication_status', 1)
                                            ->get(); 

                             $i=1;
                                            
                        foreach ($all_publication_slider as $v_slider) {
                                                # code...
                                 if ($i==1) {
                                           

                ?>
                            <div class="item active">
                           <?php }else{ ?>
                            <div class="item">
                           <?php } ?>     
                               {{--  <div class="col-sm-4">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Ladish Shopping Bag</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div> --}}
                                <div class="col-sm-8">
                                    <img src="{{URL::to($v_slider->slider_image)}}" class="girl img-responsive" alt="" />
                                </div>
                            </div>
                    <?php $i++; } ?>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->