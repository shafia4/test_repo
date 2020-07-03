@extends('layouts.app')

@section('headsection')

<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

            <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="m-5">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-5 border-x-0 border-x-md border-y border-y-md-0 text-center" style="border-left:0px !important;">

                                    <h3 class="display-4">Your digital Safe Haven</h3>

                                    <p class="lead mt-10">
                                        {{ env('APP_NAME') }} helps you and maybe your beloved ones to have a constant overview of your financial status and keep all relvant information, contracts and documents in one save place
                                    </p>
                                    <br />
                                    <div>
                                        <a href="#" class="btn btn-danger font-weight-bold font-size-h3 px-12 py-5">Signup for € 3,90 / month</a>
                                        <p class="text-dark-50">90 days free-trial</p>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <img src="{{ URL::to('img/landing3.png') }}" style="width:100%;" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>

    </div>
</div>

@endsection

@section('content')

<div class="d-flex flex-column-fluid" style="background-color:none;">
    <!--begin::Container-->
    <div class="container">
        <div class="p-10 text-center mb-10">
            <h3 class="display-4 text-dark">5 minutes & 3.90 EUR per month for your security!</h3>
        </div>
    </div>
    <!--end::Container-->
</div>

<div class="d-flex flex-column-fluid p-20" style="background-color:#E05842;">
    <!--begin::Container-->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header pb-0">
                        <i class="fas fa-mobile-alt fa-4x"></i>
                        <h3 class="display-5 m-5">Always Informed</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Keep records of all your assets in one secure place. Have all your contracts, important documents and user accounts in your pocket.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header pb-0">
                        <i class="fas fa-file-signature fa-4x"></i>
                        <h3 class="display-5 m-5">Create Security</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Give your beloved ones the possibility to have an overview on your assets and obligations. They can access your data with their unique code after a defined grace period.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header pb-0">
                        <i class="fas fa-lock fa-4x"></i>
                        <h3 class="display-5 m-5">Privacy</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            We strongly believe in creating a sustainable app. Your finance is your own. That’s why we will never ever sell or analyze your private data. We we never budge on privacy.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-10">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header pb-0">
                        <i class="fas fa-balance-scale fa-4x"></i>
                        <h3 class="display-5 m-5">Insurance</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Take snapshots of your assets and create a virtual prove of your belongings that might be covered under a insurance policy
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header pb-0">
                        <i class="fas fa-coffee fa-4x"></i>
                        <h3 class="display-5 m-5">One coffee per month</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            {{ env('APP_NAME') }} is a paid service. We make money by charging the user and have no other income stream. This allows us to keep your data save and the infrastructure to the highest standards.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header pb-0">
                        <i class="fab fa-btc fa-4x"></i>
                        <h3 class="display-5 m-5">Virtual Assets</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Your cryptocurrency accounts, virtaul investment accounts or crowdfunding contracts are save with us. Never forger your money in the online poker account of investly.co again.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>


<div class="d-flex flex-column-fluid" style="background-color:#FFFFFF;">
    <!--begin::Container-->
    <div class="container">
        <div class="row m-5 p-20">
            <div class="col col-md-6 text-center">
                <p class="lead mt-5">
                    Who was the Artist? Is it original? did I buy it at this exhibition?
                </p>
                <h3 class="display-5">Have all relevant information on your favourite art pieces stored forever. For you and your beloved ones that will outlive you.</h3>
            </div>
            <div class="col col-md-6 text-center"><img src="{{ URL::to('img/art.jpg') }}" style="width:80%;" /></div>
        </div>

        <div class="row m-5 p-20">
            <div class="col col-md-6 text-center"><img src="{{ URL::to('img/hausrazanac.jpg') }}" style="width:80%;" /></div>
            <div class="col col-md-6 text-center">

                <p class="lead mt-5">
                    The termination of the rental contract? The invoice of the windows? The excerpt of the land book?
                </p>
                <h3 class="display-5">Centrally store it on white.APP</h3>
            </div>
        </div>

        <div class="row m-5 p-20">
            <div class="col col-md-6 text-center">
                <p class="lead mt-5">
                    When did I buy it? For how much? Was it maintained?
                </p>
                <h3 class="display-5">Everything you need to know on need on your most precious belongings.</h3>
            </div>
            <div class="col col-md-6 text-center"><img src="{{ URL::to('img/uhr.jpg') }}" style="width:80%;" /></div>
        </div>
    </div>
    <!--end::Container-->
</div>


<div class="d-flex flex-column-fluid p-20" style="background-color:#E05842;">
    <!--begin::Container-->
    <div class="container">
        <div class="row">

            <div class="col-md-12 text-center">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/xJlvtquvbDY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            </div>

        </div>
    </div>
    <!--end::Container-->
</div>

<div class="d-flex flex-column-fluid p-20" style="height: 60vh;background-image: url({{ URL::to('/img/altedonau.jpg') }}) ; min-width: 100% min-height: 100%; background-color: #cccccc;color:white; text-align:center;background-repeat:no-repeat;  background-size: 100% 120%; ">
    <!--begin::Container-->
    <div class="container">
        <div class="row">

            <div class="col-md-12 text-center">
                <h3 class="display-3">{{ env('APP_NAME') }} made with love in Vienna, Austria and Dalmatia, Croatia</h3>
            </div>

        </div>
    </div>
    <!--end::Container-->
</div>
@endsection
