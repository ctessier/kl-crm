@extends('layouts.app')

@section('header', 'Tableau de bord')

@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>4</h3>
                <p>cartons ce mois-ci</p>
            </div>
            <div class="icon">
                <i class="fa fa-dropbox"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>+2</h3>
                <p>consommateurs</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
        </div>
    </div>
</div>
@endsection
