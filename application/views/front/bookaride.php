<!--breadcrumb section start-->
<section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
    <img src="<?=base_url()?>assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
    <img src="<?=base_url()?>assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                    <h1 class="text-white">Book a Ride</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--breadcrumb section end-->

<!--bike listing start-->
<section class="bike-listing ptb-80 light-bg">
    <div class="container">
        <div class="row g-4">
            <div class="col-xl-3">
                <div class="listing-sidebar rounded bg-white">
                    <div class="sidebar-widget bl-search-widget">
                        <div class="widget-top bg-secondary py-2 px-4">
                            <h4 class="mb-1 text-white">Search</h4>
                            <p class="mb-0 fs-sm text-white">Find your Motorcycle</p>
                        </div>
                        <form method="POST" action="<?=base_url('Bookaride')?>" class="blw-search-form mt-2 p-4">
                            <div class="blw-search-fields position-relative">
                                <div class="row g-2 mb-2">
                                    <h4 class="h5 mb-1 text-black">Pickup</h4>
                                    <div class="col-6 position-relative">
                                        <input type="text" value="<?=$pickup_date?>" name="pickup_date" id="pickup_date" class="form-control theme-date-input">
                                    </div>
                                    <div class="col-6 position-relative">
                                        <select id="pickup_time" data-select="<?=$pickup_time?>" name="pickup_time" class="form-select">
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <h4 class="h5 mb-1 text-black">Dropoff</h4>
                                    <div class="col-6  position-relative">
                                        <input type="text" name="dropoff_date" value="<?=$dropoff_date?>" id="dropoff_date" class="form-control theme-date-input">
                                    </div>
                                    <div class="col-6">
                                        <select id="dropoff_time" data-select="<?=$dropoff_time?>" name="dropoff_time" class="form-select">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn md-primary-btn mt-40 w-100">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="bike-inventory">
                    <form id="cartform" method="POST" action="<?=base_url('Cart')?>">
                        <input type="hidden" name="bike_ids" value="">
                        <input type="hidden" name="pickup_date" value="<?=$pickup_date?>">
                        <input type="hidden" name="pickup_time" value="<?=$pickup_time?>">
                        <input type="hidden" name="dropoff_date" value="<?=$dropoff_date?>">
                        <input type="hidden" name="dropoff_time" value="<?=$dropoff_time?>">
                        <input type="hidden" name="period_days" value="<?=$period_days?>">
                        <input type="hidden" name="period_hours" value="<?=$period_hours?>">
                        <input type="hidden" name="public_holiday" value="<?=$public_holiday?>">
                        <input type="hidden" name="weekend" value="<?=$weekend?>">
                        <!-- <a id="checkout" style="display: none;float: right;" class="btn btn-sm btn-primary" href="javascript:void(0)">Book Now</a> -->
                    </form>
                    <div class="row g-2">
                        <?php if( isset($available_bikes) && count($available_bikes) > 0 ){
                            foreach($available_bikes as $bike){ ?>
                            <div class="col-xxl-4 col-xl-6 col-lg-4 col-md-6">
                                <div class="md-listing-single bg-white position-relative">   
                                    <figure style="border-bottom: 1px solid #FFDD06;" class="overflow-hidden rounded-top mb-0">
                                        <img src="<?=base_url('bikes/'.$bike['image'])?>" alt="<?=$bike['bike_type_name']?>" style="max-width: 315px;height: 186px;" class="img-fluid m-2">
                                    </figure>
                                    <div class="md-listing-single-content">
                                        <a href="<?=base_url('Bookaride/view?id='.$bike['bike_type_id'])?>">
                                            <h6 class="mb-1"><?=$bike['bike_type_name']?></h6>
                                        </a>    
                                        <ul class="meta-list d-flex justify-content-between mt-3 pt-2">
                                            <li class="m-0">
                                                <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M21.4886 4.85227H19.4091C19.0258 4.85227 18.7159 5.16282 18.7159 5.54545V6.23864H18.0227V5.54545C18.0227 5.16282 17.7129 4.85227 17.3295 4.85227H16.2302L14.3544 2.97652C14.2906 2.91206 14.2137 2.86145 14.1284 2.8261C14.0439 2.79144 13.9537 2.77273 13.8636 2.77273H11.7841V1.38636H13.1705C13.5538 1.38636 13.8636 1.07582 13.8636 0.693182C13.8636 0.310545 13.5538 0 13.1705 0H6.93182C6.54849 0 6.23864 0.310545 6.23864 0.693182C6.23864 1.07582 6.54849 1.38636 6.93182 1.38636H8.31818V2.77273H6.23864C6.21645 2.77273 6.19774 2.78312 6.17625 2.7852C6.12634 2.79006 6.0799 2.79907 6.03276 2.81432C5.99186 2.82749 5.95443 2.84205 5.917 2.86215C5.87818 2.88294 5.84283 2.9072 5.80748 2.93562C5.77074 2.96612 5.73885 2.99801 5.70905 3.03475C5.69449 3.05208 5.67508 3.06248 5.66191 3.08189L4.48142 4.85227H2.77273C2.3894 4.85227 2.07955 5.16282 2.07955 5.54545V7.625H1.38636V5.54545C1.38636 5.16282 1.07651 4.85227 0.693182 4.85227C0.309852 4.85227 0 5.16282 0 5.54545V11.7841C0 12.1667 0.309852 12.4773 0.693182 12.4773C1.07651 12.4773 1.38636 12.1667 1.38636 11.7841V9.01136H2.07955V11.7841C2.07955 12.1667 2.3894 12.4773 2.77273 12.4773H4.42389L5.61893 14.8667C5.65151 14.9318 5.69449 14.9887 5.74301 15.0386C5.75272 15.049 5.76519 15.0559 5.77559 15.0649C5.82481 15.11 5.87957 15.146 5.93918 15.1751C5.95928 15.1848 5.97939 15.1939 6.00087 15.2015C6.07643 15.2299 6.15545 15.2493 6.23725 15.25C6.23794 15.25 6.23794 15.25 6.23864 15.25H14.5568C14.658 15.25 14.753 15.2257 14.8396 15.1869C14.8625 15.1765 14.8798 15.1578 14.9013 15.1453C14.9644 15.1079 15.0226 15.0663 15.0712 15.0115C15.0788 15.0025 15.0906 14.9998 15.0982 14.9901L17.663 11.7841H18.7159V12.4773C18.7159 12.8599 19.0258 13.1705 19.4091 13.1705H21.4886C21.872 13.1705 22.1818 12.8599 22.1818 12.4773V5.54545C22.1818 5.16282 21.872 4.85227 21.4886 4.85227ZM20.7955 11.7841H20.1023V11.0909C20.1023 10.7083 19.7924 10.3977 19.4091 10.3977H17.3295C17.3164 10.3977 17.3053 10.4047 17.2921 10.4054C17.245 10.4081 17.2006 10.4206 17.1549 10.4331C17.1119 10.4449 17.0696 10.4532 17.0301 10.4719C16.994 10.4892 16.9635 10.5156 16.9303 10.5391C16.8901 10.5683 16.8506 10.596 16.8173 10.6334C16.8083 10.6431 16.7965 10.6473 16.7882 10.6577L14.2234 13.8636H6.66702L5.47198 11.4742C5.45673 11.4437 5.43039 11.4236 5.41098 11.3959C5.38186 11.3543 5.35622 11.3127 5.31878 11.2781C5.28551 11.2476 5.24739 11.2275 5.20926 11.2046C5.17183 11.181 5.13717 11.1561 5.09489 11.1401C5.04706 11.1221 4.99645 11.1173 4.94516 11.1096C4.91397 11.1055 4.88555 11.0909 4.85227 11.0909H3.46591V6.23864H4.85227H4.85297C4.93545 6.23864 5.01586 6.21923 5.09281 6.19011C5.10806 6.18457 5.12331 6.17972 5.13856 6.17278C5.20857 6.1409 5.27303 6.09861 5.32987 6.04385C5.34097 6.03345 5.34928 6.02098 5.35968 6.00989C5.38325 5.98424 5.4089 5.95998 5.42831 5.93017L6.60949 4.15909H9.01136C9.39469 4.15909 9.70455 3.84855 9.70455 3.46591V1.38636H10.3977V3.46591C10.3977 3.84855 10.7076 4.15909 11.0909 4.15909H13.5767L15.4524 6.03484C15.5162 6.09931 15.5931 6.14991 15.6784 6.18526C15.763 6.21992 15.8531 6.23864 15.9432 6.23864H16.6364V6.93182C16.6364 7.31445 16.9462 7.625 17.3295 7.625H19.4091C19.7924 7.625 20.1023 7.31445 20.1023 6.93182V6.23864H20.7955V11.7841Z" fill="#99CF8F"></path>
                                                    <path d="M13.5585 6.35746C13.2403 6.14257 12.8105 6.22645 12.5956 6.54323L9.72588 10.7848L8.04768 9.48995C7.74338 9.25565 7.30944 9.3125 7.07584 9.61542C6.84224 9.91834 6.89839 10.3537 7.20131 10.5873L9.46385 12.3327C9.58585 12.4277 9.73489 12.4776 9.88739 12.4776C9.92413 12.4776 9.96017 12.4748 9.9976 12.4686C10.1861 12.4381 10.3546 12.3313 10.4613 12.1726L13.7442 7.32029C13.9591 7.00281 13.8753 6.57235 13.5585 6.35746Z" fill="#99CF8F"></path>
                                                </svg>
                                                <span class="d-inline-block fa-sm font-bold text-black m-1"><?=$bike['cc']?></span></li>

                                            <li class="m-0">
                                                <svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.4372 15.1074H8.49606C8.15738 15.1074 7.88281 15.382 7.88281 15.7207C7.88281 16.0593 8.15738 16.3339 8.49606 16.3339H12.4372C12.7758 16.3339 13.0504 16.0593 13.0504 15.7207C13.0504 15.382 12.7758 15.1074 12.4372 15.1074Z" fill="#99CF8F"></path>
                                                    <path d="M12.1901 11.3227C12.3188 11.0643 12.3917 10.7731 12.3917 10.4648C12.3917 9.40095 11.5292 8.53848 10.4653 8.53848C10.1569 8.53848 9.8657 8.61133 9.60728 8.74016L6.71874 5.85149C6.47929 5.612 6.09099 5.612 5.85149 5.85149C5.612 6.09094 5.612 6.47921 5.85149 6.71874L8.74024 9.60761C8.61166 9.86583 8.53897 10.1568 8.53897 10.4648C8.53897 11.5287 9.40144 12.3912 10.4653 12.3912C10.7735 12.3912 11.0645 12.3185 11.3227 12.1899L12.0022 12.8694C12.2417 13.1089 12.63 13.109 12.8695 12.8695C13.109 12.6301 13.109 12.2418 12.8695 12.0023L12.1901 11.3227ZM10.4653 11.1647C10.0794 11.1647 9.76542 10.8508 9.76542 10.4649C9.76542 10.079 10.0794 9.76501 10.4653 9.76501C10.8512 9.76501 11.1652 10.079 11.1652 10.4649C11.1652 10.8508 10.8512 11.1647 10.4653 11.1647Z" fill="#99CF8F"></path>
                                                    <path d="M10.466 0C4.69503 0 0 4.69503 0 10.466C0 12.3053 0.484953 14.1151 1.40249 15.6997C1.57199 15.9924 1.94656 16.0926 2.23952 15.9236C2.23965 15.9235 3.94642 14.9382 3.94642 14.9382C4.23972 14.7689 4.34021 14.3939 4.17087 14.1005C4.00153 13.8073 3.62656 13.7066 3.33318 13.8761L2.17489 14.5448C1.64284 13.4647 1.32784 12.2854 1.24766 11.0793H2.5838C2.92247 11.0793 3.19704 10.8047 3.19704 10.4661C3.19704 10.1274 2.92247 9.85282 2.5838 9.85282H1.24734C1.32878 8.61627 1.65441 7.44551 2.17665 6.38828L3.33322 7.05602C3.6266 7.22548 4.00166 7.12486 4.17091 6.83157C4.34025 6.53824 4.23976 6.16318 3.94647 5.99388L2.79132 5.32692C3.46364 4.32619 4.32623 3.4636 5.32696 2.79128L5.99384 3.9463C6.16318 4.23964 6.53824 4.34021 6.83153 4.17075C7.12482 4.00137 7.22531 3.62635 7.05598 3.33306L6.38828 2.1766C7.44551 1.65441 8.61631 1.32898 9.85278 1.24742V2.58384C9.85278 2.92251 10.1273 3.19708 10.466 3.19708C10.8047 3.19708 11.0793 2.92251 11.0793 2.58384V1.24742C12.3157 1.32898 13.4865 1.65445 14.5438 2.1766L13.8761 3.33306C13.7067 3.62635 13.8072 4.00141 14.1005 4.17075C14.3938 4.34021 14.7689 4.23964 14.9382 3.9463L15.6051 2.79128C16.6058 3.46356 17.4684 4.32615 18.1407 5.32692L16.9856 5.9938C16.6923 6.16314 16.5918 6.53815 16.7612 6.83149C16.9305 7.12478 17.3055 7.2254 17.5989 7.05594L18.7554 6.3882C19.2776 7.44543 19.6033 8.61619 19.6847 9.85273H18.3482C18.0096 9.85273 17.735 10.1273 17.735 10.466C17.735 10.8047 18.0096 11.0792 18.3482 11.0792H19.6844C19.6042 12.2853 19.2892 13.4646 18.7571 14.5447L17.5989 13.876C17.3055 13.7066 16.9305 13.8072 16.7612 14.1005C16.5918 14.3938 16.6923 14.7689 16.9856 14.9382C16.9856 14.9382 18.6924 15.9234 18.6925 15.9235C18.9855 16.0925 19.3601 15.9924 19.5296 15.6996C20.4471 14.1151 20.932 12.3054 20.932 10.466C20.932 4.69503 16.237 0 10.466 0Z" fill="#99CF8F"></path>
                                                </svg>
                                                <span class="d-inline-block fa-sm font-bold text-black m-1"><?=$bike['milage']?></span></li>
                                            <li class="m-0">
                                                <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1337 0.00012207C17.4399 0.00012207 18.5 1.06021 18.5 2.3664C18.5 3.67259 17.4399 4.73268 16.1337 4.73268C14.8275 4.73268 13.7674 3.67259 13.7674 2.3664C13.7674 1.06021 14.8275 0.00012207 16.1337 0.00012207ZM16.1337 1.29082C15.54 1.29082 15.0581 1.77268 15.0581 2.3664C15.0581 2.96012 15.54 3.44198 16.1337 3.44198C16.7274 3.44198 17.2093 2.96012 17.2093 2.3664C17.2093 1.77268 16.7274 1.29082 16.1337 1.29082Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1337 12.047C17.4399 12.047 18.5 13.1071 18.5 14.4133C18.5 15.7195 17.4399 16.7796 16.1337 16.7796C14.8275 16.7796 13.7674 15.7195 13.7674 14.4133C13.7674 13.1071 14.8275 12.047 16.1337 12.047ZM16.1337 13.3377C15.54 13.3377 15.0581 13.8196 15.0581 14.4133C15.0581 15.007 15.54 15.4889 16.1337 15.4889C16.7274 15.4889 17.2093 15.007 17.2093 14.4133C17.2093 13.8196 16.7274 13.3377 16.1337 13.3377Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.25091 0.00012207C10.5571 0.00012207 11.6172 1.06021 11.6172 2.3664C11.6172 3.67259 10.5571 4.73268 9.25091 4.73268C7.94472 4.73268 6.88463 3.67259 6.88463 2.3664C6.88463 1.06021 7.94472 0.00012207 9.25091 0.00012207ZM9.25091 1.29082C8.65719 1.29082 8.17533 1.77268 8.17533 2.3664C8.17533 2.96012 8.65719 3.44198 9.25091 3.44198C9.84463 3.44198 10.3265 2.96012 10.3265 2.3664C10.3265 1.77268 9.84463 1.29082 9.25091 1.29082Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.25091 12.047C10.5571 12.047 11.6172 13.1071 11.6172 14.4133C11.6172 15.7195 10.5571 16.7796 9.25091 16.7796C7.94472 16.7796 6.88463 15.7195 6.88463 14.4133C6.88463 13.1071 7.94472 12.047 9.25091 12.047ZM9.25091 13.3377C8.65719 13.3377 8.17533 13.8196 8.17533 14.4133C8.17533 15.007 8.65719 15.4889 9.25091 15.4889C9.84463 15.4889 10.3265 15.007 10.3265 14.4133C10.3265 13.8196 9.84463 13.3377 9.25091 13.3377Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.36614 0.000244141C3.67233 0.000244141 4.73242 1.06034 4.73242 2.36652C4.73242 3.67271 3.67233 4.7328 2.36614 4.7328C1.05996 4.7328 -0.000135422 3.67271 -0.000135422 2.36652C-0.000135422 1.06034 1.05996 0.000244141 2.36614 0.000244141ZM2.36614 1.29094C1.77242 1.29094 1.29056 1.7728 1.29056 2.36652C1.29056 2.96024 1.77242 3.4421 2.36614 3.4421C2.95986 3.4421 3.44172 2.96024 3.44172 2.36652C3.44172 1.7728 2.95986 1.29094 2.36614 1.29094Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.36614 12.047C3.67233 12.047 4.73242 13.1071 4.73242 14.4133C4.73242 15.7195 3.67233 16.7796 2.36614 16.7796C1.05996 16.7796 -0.000135422 15.7195 -0.000135422 14.4133C-0.000135422 13.1071 1.05996 12.047 2.36614 12.047ZM2.36614 13.3377C1.77242 13.3377 1.29056 13.8196 1.29056 14.4133C1.29056 15.007 1.77242 15.4889 2.36614 15.4889C2.95986 15.4889 3.44172 15.007 3.44172 14.4133C3.44172 13.8196 2.95986 13.3377 2.36614 13.3377Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7793 4.08785V12.6925C16.7793 13.0487 16.4902 13.3379 16.1339 13.3379C15.7777 13.3379 15.4886 13.0487 15.4886 12.6925V4.08785C15.4886 3.73162 15.7777 3.4425 16.1339 3.4425C16.4902 3.4425 16.7793 3.73162 16.7793 4.08785Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.89453 4.08785V12.6925C9.89453 13.0487 9.60542 13.3379 9.24918 13.3379C8.89295 13.3379 8.60383 13.0487 8.60383 12.6925V4.08785C8.60383 3.73162 8.89295 3.4425 9.24918 3.4425C9.60542 3.4425 9.89453 3.73162 9.89453 4.08785Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.01186 4.08785V7.52971C3.01186 7.64846 3.10823 7.74483 3.22697 7.74483H16.1339C16.4902 7.74483 16.7793 8.03395 16.7793 8.39018C16.7793 8.74641 16.4902 9.03553 16.1339 9.03553H3.22697C2.3949 9.03553 1.72116 8.36092 1.72116 7.52971C1.72116 6.2743 1.72116 4.08785 1.72116 4.08785C1.72116 3.73162 2.01028 3.4425 2.36651 3.4425C2.72274 3.4425 3.01186 3.73162 3.01186 4.08785Z" fill="#99CF8F"></path>
                                                </svg>
                                                <span class="d-inline-block fa-sm font-bold text-black m-1"><?=$bike['power']?></span></li>
                                        </ul>
                                        <div class="pricing-bottom d-flex align-items-center justify-content-between mt-4">
                                            <h5 class="mb-0"><i class="fa fa-indian-rupee-sign me-1"></i><?=$bike['rent_price']?></h5>
                                            <?php if(isset($bike['not_available']) && $bike['not_available'] == $bike['bikes_available']) { ?>
                                            <a href="javascript:void(0)" title="<?=$bike['bike_type_name']?>">Sold Out</a>
                                            <?php } else { ?>
                                            <a href="javascript:void(0)" class="booknow btn md-primary-btn p-1 px-2" bike-name="<?=$bike['bike_type_name']?>" bike-id="<?=$bike['bike_type_id']?>" title="Book Now">BOOK NOW</a>    
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--bike listing end-->
<script type="text/javascript">

$(document).ready(function(){

    let bikesincart = 0;
    let bike_ids = [];

    var today = new Date();
    var today_date = getdateformat(today);
    var hour = today.getHours();
    console.log("today="+today_date);
    console.log(hour);

    function setTimeSpecial(ele, hour)
    {
    let start = hour;
    let len = 7 + 14 - hour;
    for (let i = 1; i <= len; i++) 
    {
      if( start == 7 )
      {
        let t = ( start < 10 ) ? "0"+start : start;
        let m = "30";
        let ap = "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));
      }
      else
      {
        //console.log("start="+start);
        let t = ( start < 10 ) ? "0"+start : start;
        if( start > 12 )
        {
          t = start - 12;
          t = ( t < 10 ) ? "0"+t : t;
        }
        let m = "00";
        let ap = ( start >= 12 ) ? "PM" : "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));

        if( start != 20 ){
          let mh = "30";
          ele.append($('<option>', {
              value: t+":"+mh+" "+ap,
              text: t+":"+mh+" "+ap
          }));
        }
      }      
      start = start + 1;
    }
    }

    function setTimeAll(ele)
    {
        let start = 7;
        for (let i = 1; i <= 14; i++) 
        {
          if( start == 7 )
          {
            let t = ( start < 10 ) ? "0"+start : start;
            let m = "30";
            let ap = "AM";
            ele.append($('<option>', {
                value: t+":"+m+" "+ap,
                text: t+":"+m+" "+ap
            }));
          }
          else
          {
            //console.log("start="+start);
            let t = ( start < 10 ) ? "0"+start : start;
            if( start > 12 )
            {
              t = start - 12;
              t = ( t < 10 ) ? "0"+t : t;
            }
            let m = "00";
            let ap = ( start >= 12 ) ? "PM" : "AM";
            ele.append($('<option>', {
                value: t+":"+m+" "+ap,
                text: t+":"+m+" "+ap
            }));

            if( start != 20 ){
              let mh = "30";
              ele.append($('<option>', {
                  value: t+":"+mh+" "+ap,
                  text: t+":"+mh+" "+ap
              }));
            }
          }      
          start = start + 1;
        }
    }

    function addtoCart(ele)
    {
        var bikeId = ele.attr("bike-id");
        if( ele.hasClass('carted') )
        {
            ele.removeClass('carted');
            ele.find('i').eq(0).removeClass('fa-check-circle').addClass('fa-circle-plus');
            bikesincart = parseInt(bikesincart) - 1;
            var temp = bike_ids;
            temp = temp.filter(item => item.bike_id !== bikeId);
            bike_ids = temp;
        }
        else
        {
            bikesincart = parseInt(bikesincart) + 1;
            ele.addClass('carted');
            ele.find('i').eq(0).removeClass('fa-circle-plus').addClass('fa-check-circle');
            bike_ids.push({"bike_id":bikeId,"qty":1});
        }
        console.log(bikesincart);
        
        localStorage.setItem("bikesincart", bikesincart);
        localStorage.setItem("bike_ids", JSON.stringify(bike_ids));

        $("#cartform input[name='bikesincart']").val(bikesincart);
        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
        $("#cartform").submit();
    }

    function checklocalStorage()
    {
        console.log('checklocalStorage');
        var bikesincart_local = localStorage.getItem("bikesincart");
        var bike_ids_local = localStorage.getItem("bike_ids");

        console.log("localStorage"+bikesincart_local);
        console.log("localStorage"+bike_ids_local);

        if( bike_ids_local != null )
        {
            var bi = JSON.parse(bike_ids_local);
            for (var prop in bi) 
            {
                var item = bi[prop];
                $(".addtocart").each(function(index, element)
                {
                    if( $(this).attr('bike-id') == item.bike_id)
                    {
                        console.log('click'+item.bike_id);
                        addtoCart($(this));
                    }
                });
            }
        }
        else
        {
            bike_ids_local = [];
            bikesincart_local = 0;
        }
        return true;
    }

    checklocalStorage();

    $(".booknow").click(function(){
        addtoCart($(this));
    });

    

    function dateformatstring(this_date)
    {
        var dt = this_date.split('-');
        return dt[2]+"-"+dt[1]+"-"+dt[0];
    }

    function getdateformat(this_date)
    {
        var dt = this_date.getDate();
        var mt = this_date.getMonth();
        mt = mt + 1;
        var yt = this_date.getFullYear();
        if( mt < 10 ){
          mt = "0"+mt;
        }

        if( dt < 10 ){
          dt = "0"+dt;
        }
        return yt+"-"+mt+"-"+dt;
    }

    

  <?php if(!isset($available_bikes)) { ?>
    localStorage.setItem("bikesincart", bikesincart);
    localStorage.setItem("bike_ids", JSON.stringify(bike_ids));
    $(".blw-search-form").submit();
  <?php } ?>

    var today = new Date();
    var today_date = getdateformat(today);
    var current_hour = today.getHours();
    console.log("today="+today_date);
    console.log(current_hour);
    current_hour = current_hour + 1;
    var pickupdate = $("#pickup_date").val();
    console.log("pickupdate="+pickupdate);
    if( pickupdate == "" )
    {
        pickupdate = dateformatstring(today_date);
        $("#pickup_date").val(pickupdate);
        $("#dropoff_date").val(pickupdate);
    }

    pickupdate = dateformatstring(pickupdate);
    console.log("pickupdate="+pickupdate);
    
    var now = moment(today_date); //todays date
    var end = moment(pickupdate); // another date
    var duration = moment.duration(now.diff(end));
    var days = duration.asDays();
    var hours = duration.asHours();
    $("#pickup_time").empty();
    $("#dropoff_time").empty();
    if( days == 0 )
    {
        //cureent days
        if( current_hour >= 20 )
        {
            var date = new Date();
            date.setDate(date.getDate() + 1);
            today_date = getdateformat(date);
            console.log("Nextday="+today_date);
            // Settime
            setTimeAll($("#pickup_time"));
            $("#pickup_time option:first").attr('selected','selected');

            setTimeAll($("#dropoff_time"));
            $("#dropoff_time option:last").attr('selected','selected');
        }
        else if( current_hour <= 7 )
        {
            setTimeAll($("#pickup_time"));
            $("#pickup_time option:first").attr('selected','selected');
            setTimeAll($("#dropoff_time"));
            $("#dropoff_time option:last").attr('selected','selected');
        }
        else
        {
            setTimeSpecial($("#pickup_time"), current_hour);
            $("#pickup_time option:first").attr('selected','selected');
            setTimeAll($("#dropoff_time"), current_hour);
            $("#dropoff_time option:last").attr('selected','selected');
        }
    }
    else
    {
        setTimeAll($("#pickup_time"));
        $("#pickup_time option:first").attr('selected','selected');
        setTimeAll($("#dropoff_time"));
        $("#dropoff_time option:last").attr('selected','selected');
    }

    $("#pickup_date").datetimepicker({
        format: 'DD-MM-Y',
        minDate:moment(today_date),
        defaultDate:moment(today_date),
        icons: {
          time: "fa fa-clock"
        }
    }).on('dp.change', function(e) {
        console.log('Pickup date');
        pickupdate = $(this).val();
        var temp = pickupdate.split('-');
        pickupdate = temp[2]+"-"+temp[1]+"-"+temp[0];
        $("#dropoff_date").datetimepicker('minDate', moment(pickupdate));

        var pd = $("#pickup_date").val();

        const date1 = moment(today_date);
        const date2 = moment(dateformatstring(pd));
        
        const duration = moment.duration(date2 - date1);
        const res = duration.as('hours');
        console.log('pickupdate-today='+res+"hours");
        if( res >= 24 )
        {
            $("#pickup_time").empty();
            setTimeAll($("#pickup_time"));
            $("#pickup_time option:first").attr('selected','selected');
        }
        else
        {
            $("#pickup_time").empty();
            setTimeSpecial($("#pickup_time"), hour);
            $("#pickup_time option:first").attr('selected','selected');
        }
    });

    $("#dropoff_date").datetimepicker({
        format: 'DD-MM-Y',
        minDate:moment(today_date),
        defaultDate:moment(today_date),
        icons: {
          time: "fa fa-clock"
        }
    }).on('dp.change', function(e) {
        console.log('Dropoff date');
        console.log();

        var pd = $("#pickup_date").val();
        var dp = $(this).val();

        const date1 = moment(dateformatstring(pd));
        const date2 = moment(dateformatstring(dp));

        const duration = moment.duration(date2 - date1);
        const res = duration.as('hours');
        console.log('pickupdate-drop='+res+"hours");
        if( res >= 24 )
        {
            $("#dropoff_time").empty();
            setTimeAll($("#dropoff_time"));
            $("#dropoff_time option:last").attr('selected', 'selected');
        }
        else
        {
            $("#dropoff_time").empty();
            setTimeSpecial($("#dropoff_time"), hour);
            $("#dropoff_time option:last").attr('selected', 'selected');
        }

    });



});

</script>