@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Browse Talents', 'url' => '/talents', 'active' => true ] ] ])

@section('sidebar.page-header')
  <i class="fa fa-search"></i> Browse Talents
@stop


@section('sidebar.body')

  <div class="talents-wrapper">

    <div class="talents-search-filter-content">
      <div class="row clearfix">
        <div id="filter-content-modal" class="" tabindex="" role="dialog" aria-hidden="false">
          <div class="display-block-sm-lg">
            @include('talent.components.filter')
          </div>
          <div id="submission-total" class="row">
            <div class="margin-left-small-normal margin-bottom-small col-md-12">
              There are <span data-bind="<%= total %>"></span> talents that match your search criteria.
            </div>
          </div>
        </div>
        <div class="display-none-sm-lg col-md-12"><button id="filter-button-modal" data-toggle="modal" data-target="#filter-content-modal" class="btn btn-block btn-flat btn-primary border-radius-zero btn-lg button-float-bottom talents-index">Filter</button></div>
      </div>
      <div class="row">
        <div class="col-md-12 talents-search-result" id="talent-search-result">
          <div class="row" id="talent-result">
            @include('components.talent4', [ 'databind' => [ 'template' => '#talent-result', 'value' => 'data' ], 'ratings' => true, 'default_btn' => true, 'notes' => false, 'favorites_notes' => false, 'class' => 'col-lg-2 col-md-2 col-sm-3 col-xs-6'  ])
          </div>
        </div> {{-- talents-search-results --}}
      </div>
      <div class="row-fluid clearfix">
        <div class="col-xs-12">
          <div id="no-talent-result" class="padding-normal text-align-center padding-top-normal-zz-xs hidden">
            <i class="fa fa-exclamation-triangle fa-5x text-danger"></i>
            <div class="padding-zero">
              <span class="margin-zero text-danger"><h4>There's no found talents!</h4></span>
            </div>
          </div>
        </div>
      </div>
      <a href="javascript:" id="go-to-top-btn" class="talents-page-goto-top-btn">
        <i class="fa fa-chevron-up"></i>
      </a>

      <div id="talent-search-loader" class="text-center padding-top-large">
        <h3>Loading Talents</h3>
        <h1><i class="fa fa-spinner fa-spin"></i></h1>
      </div>
    </div>

    <div class="talents-content">
      @include('components.modals.talent-add-to-like-it-list')
      @include('components.modals.share-like-it-list')
      @include('components.modals.talent-view-photos')
      @include('components.modals.talent-resume')
    </div>

  </div>

@stop
