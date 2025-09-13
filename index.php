<?php include "layout/header.php" ?>
<!-- content begin -->
<div id="content" class="no-padding">

    <!-- slider -->
    <div id="slider">
        <!-- revolution slider begin -->
        <div class="fullwidthbanner-container">
            <div id="revolution-slider">
                <ul>
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="2500" data-delay="5000">
                        <!--  BACKGROUND IMAGE -->
                        <img src="img-rev-slider/bg-1.jpg" alt="">

                        <div class="tp-caption h-line lft" data-x="20" data-y="130" data-speed="800" data-start="1000"
                            data-easing="easeInOutCubic" data-endspeed="300">
                        </div>

                        <div class="tp-caption sfr custom-font-1" data-x="20" data-y="180" data-speed="800"
                            data-start="800" data-easing="easeInOutCubic">
                            BY AIR
                        </div>

                        <div class="tp-caption sfr custom-font-1" data-x="20" data-y="235" data-speed="800"
                            data-start="1000" data-easing="easeInOutCubic">
                            BY TRAIN
                        </div>

                        <div class="tp-caption sfr custom-font-1" data-x="20" data-y="290" data-speed="800"
                            data-start="1200" data-easing="easeInOutCubic">
                            BY ROAD
                        </div>

                        <div class="tp-caption sfb custom-font-2" data-x="20" data-y="345" data-speed="800"
                            data-start="1400" data-easing="easeInOutCubic">
                            Freight Solutions For All Industry
                        </div>

                    </li>

                    <li data-transition="fade" data-slotamount="7" data-masterspeed="2500" data-delay="5000">
                        <!--  BACKGROUND IMAGE -->
                        <img src="img-rev-slider/bg-2.jpg" alt="">

                        <div class="tp-caption h-line lft" data-x="center" data-y="170" data-speed="800"
                            data-start="1000" data-easing="easeInOutCubic" data-endspeed="300">
                        </div>

                        <div class="tp-caption lft custom-font-1" data-x="center" data-y="220" data-speed="800"
                            data-start="800" data-easing="easeInOutCubic">
                            Delivering Excellence
                        </div>

                        <div class="tp-caption sfb custom-font-2" data-x="center" data-y="270" data-speed="800"
                            data-start="1400" data-easing="easeInOutCubic">
                            We Deliver Fast National & International Cargo Services
                        </div>

                    </li>

                    <li data-transition="fade" data-slotamount="7" data-masterspeed="2500" data-delay="5000">
                        <!--  BACKGROUND IMAGE -->
                        <img src="img-rev-slider/bg-5.jpg" alt="">

                        <div class="tp-caption h-line lft" data-x="center" data-y="170" data-speed="800"
                            data-start="1000" data-easing="easeInOutCubic" data-endspeed="300">
                        </div>

                        <div class="tp-caption lft custom-font-1" data-x="center" data-y="220" data-speed="800"
                            data-start="800" data-easing="easeInOutCubic">
                            Makes You Smile
                        </div>

                        <div class="tp-caption sfb custom-font-2" data-x="center" data-y="270" data-speed="800"
                            data-start="1400" data-easing="easeInOutCubic">
                            Safe and On Time Delivery
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- revolution slider close -->
    </div>
    <!-- slider close -->
    <div class="clearfix"></div>



    <!-- section begin -->
    <section id="section-tracking">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="cta-form wow fadeIn" data-wow-delay="0s" data-wow-duration="1s">
                        <form method="get" action="/track">
                            <input type="text" name="tid" value="" placeholder="Insert tracking number here...">
                            <input type="submit" id="track-it" value="TRACK MY ORDER"> 
                        </form>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>

        <!-- <div id="section-tracking-result" class="light-text">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="divider-double"></div>
                                <div class="text-center">
                                    <h3><span class="grey">Product ID:</span> 112345679087328</h3>
                                </div>


                                <div class="divider-double"></div>

                                <div class="wrapper-line padding40 rounded10">


                                    <ul class="progress">
                                        <li><a href="#">Accepted</a></li>
                                        <li class="beforeactive"><a href="#">Order Processing</a></li>
                                        <li class="active"><a href="#">Shipment Pending</a></li>
                                        <li><a href="#">Estimated Delivery</a></li>
                                    </ul>

                                    <div class="divider-double"></div>

                                    <ul class="timeline custom-tl">

                                        <li class="timeline-inverted">
                                            <div class="timeline-date wow zoomIn" data-wow-delay=".2s">
                                                Nov 03, 2015
                                                <span>20:07 pm</span>
                                            </div>
                                            <div class="timeline-badge success"><i
                                                    class="fa fa-check-square-o wow zoomIn"></i></div>
                                            <div class="timeline-panel wow fadeInRight" data-wow-delay=".6s">
                                                <div class="timeline-body">
                                                    The shipment has been successfully delivered
                                                    <span class="location">Baker Street, UK <a
                                                            href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom"
                                                            class="popup-gmaps">view on map</a></span>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="timeline-inverted">
                                            <div class="timeline-date wow zoomIn" data-wow-delay=".2s">
                                                Nov 03, 2015
                                                <span>20:07 pm</span>
                                            </div>
                                            <div class="timeline-badge warning"><i class="fa fa-warning wow zoomIn"></i>
                                            </div>
                                            <div class="timeline-panel wow fadeInRight" data-wow-delay=".6s">
                                                <div class="timeline-body">
                                                    The shipment could not be delivered
                                                    <span class="location">Baker Street, UK <a
                                                            href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom"
                                                            class="popup-gmaps">view on map</a></span>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="timeline-inverted">
                                            <div class="timeline-date wow zoomIn" data-wow-delay=".2s">
                                                Nov 03, 2015
                                                <span>20:07 pm</span>
                                            </div>
                                            <div class="timeline-badge"><i class="fa fa-plane wow zoomIn"></i></div>
                                            <div class="timeline-panel wow fadeInRight" data-wow-delay=".6s">
                                                <div class="timeline-body">
                                                    The shipment has arrived in destination country
                                                    <span class="location">Baker Street, UK <a
                                                            href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom"
                                                            class="popup-gmaps">view on map</a></span>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="timeline-inverted">
                                            <div class="timeline-date wow zoomIn" data-wow-delay=".2s">
                                                Nov 02, 2015
                                                <span>18:05 pm</span>
                                            </div>
                                            <div class="timeline-badge"><i class="fa fa-plane wow zoomIn"></i></div>
                                            <div class="timeline-panel wow fadeInRight" data-wow-delay=".6s">
                                                <div class="timeline-body">
                                                    The shipment is being transformed to destination country
                                                    <span class="location">Baker Street, UK <a
                                                            href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom"
                                                            class="popup-gmaps">view on map</a></span>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="timeline-inverted">
                                            <div class="timeline-date wow zoomIn" data-wow-delay=".2s">
                                                Nov 01, 2015
                                                <span>10:08 pm</span>
                                            </div>
                                            <div class="timeline-badge"><i class="fa fa-plane wow zoomIn"></i></div>
                                            <div class="timeline-panel wow fadeInRight" data-wow-delay=".6s">
                                                <div class="timeline-body">
                                                    The international shipment has been processed
                                                    <span class="location">Baker Street, UK <a
                                                            href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom"
                                                            class="popup-gmaps">view on map</a></span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

    </section>
    <!-- section close -->
    <div class="clearfix"></div>



    <div class="box-container">
        <div id="bg-service-1" class="box-one-third light-text">
            <div class="inner wow" data-wow-delay="0s">
                <h2 class="wow fadeIn" data-wow-delay=".2s">Air Freight</h2>
                <p class="wow fadeIn" data-wow-delay=".3s">The word cargo refers in particular to goods or
                    produce being conveyed generally for commercial gain by ship, boat, or aircraft, although
                    the term is now often extended to cover all types of freight, including that carried by
                    train, van, truck, or container.</p>
                <div class="divider-single"></div>
                <a href="air-freight.html" class="btn-border-light wow fadeInUp" data-wow-delay=".4s"
                    data-wow-duration=".3s">Read More</a>
            </div>
        </div>



        <div id="bg-service-3" class="box-one-third light-text">
            <div class="inner">
                <h2 class="wow fadeIn" data-wow-delay=".4s">Railway Tansport</h2>
                <p class="wow fadeIn" data-wow-delay=".5s">Railway transport in India is a cornerstone of the
                    country's transportation network,
                    playing a vital role in the movement of passengers and freight. Indian Railways, one of
                    the largest railway networks in the world, spans the vast expanse of the nation. </p>
                <div class="divider-single"></div>
                <a href="railway-transport.html" class="btn-border-light wow fadeInUp" data-wow-delay=".5s"
                    data-wow-duration=".3s">Read More</a>
            </div>
        </div>

        <div id="bg-service-2" class="box-one-third light-text">
            <div class="inner">
                <h2 class="wow fadeIn" data-wow-delay=".6s">Road Transport</h2>
                <p class="wow fadeIn" data-wow-delay=".7s">Road transport in India is the backbone of the
                    country's extensive and
                    diverse transportation system. The vast network of roads, spanning from national
                    highways to rural lanes, facilitates the movement of people and goods across the nation.</p>
                <div class="divider-single"></div>
                <a href="road-transport.html" class="btn-border-light wow fadeInUp" data-wow-delay=".6s"
                    data-wow-duration=".3s">Read More</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <!-- section begin -->
    <section id="section-features">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <h2 class="wow fadeIn" data-wow-delay="0">Why Choose Us?
                        <span>Find reasons to choose us as your freight partner</span>
                    </h2>
                    <div class="small-border wow flipInY" data-wow-delay=".2s" data-wow-duration=".8s"></div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <i class="icon-tools wow zoomIn" data-wow-delay="0s"></i>
                        <div class="text wow fadeIn" data-wow-delay=".2s">
                            <h3>Customer Satisfication</h3>
                            <p>Customer satisfaction is a paramount metric that gauges the success and
                                sustainability of a business. It reflects the degree to which a company's
                                products or services meet or exceed the expectations of its customers. Achieving
                                high levels of customer satisfaction is not only indicative of a quality
                                offering but also crucial for building brand loyalty and positive word-of-mouth.
                                Businesses often employ various strategies, such as excellent customer service,
                                product quality improvement, and responsive communication, to enhance customer
                                satisfaction.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="feature-box">
                        <i class="icon-bargraph wow zoomIn" data-wow-delay=".2s"></i>
                        <div class="text wow fadeIn" data-wow-delay=".4s">
                            <h3>Consignment &amp; Traking</h3>
                            <p>Courier tracking is a valuable service that provides real-time visibility and
                                monitoring of the delivery status of packages or parcels sent through courier
                                services. With advancements in technology, most courier companies offer online
                                tracking systems that allow senders and recipients to trace the exact location
                                and transit progress of their shipments. Utilizing unique tracking numbers
                                assigned to each parcel, customers can access detailed information about the
                                package's journey, including departure and arrival times, current location, and
                                expected delivery dates.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="feature-box">
                        <i class="icon-pricetags wow zoomIn" data-wow-delay=".4s"></i>
                        <div class="text wow fadeIn" data-wow-delay=".6s">
                            <h3>Payment Options</h3>
                            <p>Payment options in India have undergone a significant transformation, driven by
                                technological advancements and the government's push for a digital economy.
                                Traditional methods like cash and cheques coexist with modern, electronic modes
                                of payment. Debit and credit cards are widely used, with increasing acceptance
                                at various merchants. Mobile wallets and digital payment platforms have gained
                                immense popularity, allowing users to make transactions seamlessly using
                                smartphones. The Unified Payments Interface (UPI) has emerged as a game-changer,
                                facilitating instant and secure fund transfers between bank accounts.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="feature-box">
                        <i class="icon-refresh wow zoomIn" data-wow-delay=".6s"></i>
                        <div class="text wow fadeIn" data-wow-delay=".8s">
                            <h3>Compliance Solutions</h3>
                            <p>Compliance solutions in India have become increasingly crucial as regulatory
                                requirements continue to evolve across various industries. These solutions are
                                designed to assist businesses in adhering to the complex and ever-changing legal
                                frameworks governing their operations. From tax compliance to environmental
                                regulations and data protection laws, companies in India need comprehensive
                                tools and strategies to ensure they meet all statutory requirements. Compliance
                                solutions often involve the use of technology, including specialized software
                                and platforms that help automate processes, track regulatory changes, and
                                generate necessary reports. </p>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
    </section>
    <!-- section close -->

    <!-- section begin -->
    <section id="section-gallery">
        <div class="container">
            <div class="row">


                <div class="col-md-12">
                    <div id="gallery" class="gallery full-gallery ex-gallery zoom-gallery">

                        <!-- gallery item -->
                        <div class="item">
                            <div class="picframe">
                                <a href="img/gallery/pic-1.jpg" data-source="img/gallery/pic-1.jpg"
                                    title="Air Delivery by Plane">
                                    <span class="overlay"></span>

                                    <span class="pf_text">
                                        <span class="project-name">Air Delivery by Plane</span>
                                        <span class="small-border"></span>
                                    </span>

                                    <img src="img/gallery/pic-1.jpg" alt="" />
                                </a>

                            </div>
                        </div>
                        <!-- close gallery item -->

                        <!-- gallery item -->
                        <div class="item">
                            <div class="picframe">
                                <a href="img/gallery/pic-2.jpg" data-source="img/gallery/pic-2.jpg"
                                    title="Land Delivery by Truck">
                                    <span class="overlay"></span>

                                    <span class="pf_text">
                                        <span class="project-name">Land Delivery by Truck</span>
                                        <span class="small-border"></span>
                                    </span>

                                    <img src="img/gallery/pic-2.jpg" alt="" />
                                </a>

                            </div>
                        </div>
                        <!-- close gallery item -->

                        <!-- gallery item -->
                        <div class="item">
                            <div class="picframe">
                                <a href="img/gallery/pic-3.jpg" data-source="img/gallery/pic-3.jpg"
                                    title="Land Delivery by Train">
                                    <span class="overlay"></span>

                                    <span class="pf_text">
                                        <span class="project-name">Land Delivery by Train</span>
                                        <span class="small-border"></span>
                                    </span>

                                    <img src="img/gallery/pic-3.jpg" alt="" />
                                </a>

                            </div>
                        </div>
                        <!-- close gallery item -->





                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->


    <?php include "ui-blocks/faq.php" ?>

    <div class="call-to-action text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h2>Contact us now to get quote for courier & cargo shipping needs.</h2>
                </div>

                <div class="col-md-3">
                    <a href="contact.html" class="btn-border-light">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- content end -->

<?php include "layout/footer.php" ?>