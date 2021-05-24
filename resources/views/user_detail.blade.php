@extends('layouts.layout')
@section('site_title', 'ホーム')
@section('content')
  <section class="container heading py-4" id="heading">
    <h1 class="mb-4">不動産投資利回りシミュレーション履歴一覧</h1>
    <p>不動産収支計算の履歴一覧です。</p>
    <p>項目を選択することで詳細の確認及び編集することができます。</p>
  </section>

  @if ($ad_top != null)
  <div class="ad-display mx-auto mb-3 mb-md-4 text-center container">
    <a href="{{ $ad_top->link }}" target="_blank" rel="nofollow noopener" class="d-inline-block mx-auto"><img src="{{ asset($ad_top->file_path) }}"></a>
  </div>
  @endif

  @if ($errors->any())
    <div>
      <ul class="list-group list-group-flush">
        @foreach ($errors->all() as $error)
          <li class="list-group-item list-group-item-danger py-3 text-center">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <x-alert type="danger" :session="session('danger')"/>
  <x-alert type="success" :session="session('success')"/>

  <main role="main">
    <x-alert type="success" :session="session('success')"/>
    <div class="album py-md-4 bg-light">
      <div class="container">
        <div class="row">
          @if ($result_calculates != null)
          @foreach ($result_calculates as $calculate)
          <a href="#" class="col-md-6 col-xl-4 mb-2 mb-md-4 calc-card px-0 px-sm-2">
            <?php $week = array( "日", "月", "火", "水", "木", "金", "土" ); ?>
            <p class="p-2 mb-2 mb-md-0 date">{{ $calculate['updated_at']->format('Y年m月d日') }} (<?= $week[date("w", strtotime($calculate['updated_at']))];?>)</p>
            <div class="card mx-2 mx-sm-0">
              <div class="card-body p-0">
                <div class="card-text d-flex p-2 border-bottom property-name-box">
                  <p class="d-inline-block mr-3 item-title">
                    物件名
                  </p>
                  <p class="d-inline-block property-name">
                    @if (isset($calculate['property_name']))
                    {{ $calculate['property_name'] }}
                    @endif
                  </p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex w-50 p-2 border-right">
                    <p class="d-inline-block item-title">表面利回り</p>
                    <p class="d-inline-block ml-auto item-value minus-check calc_surface_yield">{{ $calculate['surface_yield'] }}</p><span class="item-value">%</span>
                  </div>
                  <div class="d-flex w-50 p-2">
                    <p class="d-inline-block item-title">実質利回り</p>
                    <p class="d-inline-block ml-auto item-value minus-check calc_real_yield">{{ $calculate['real_yield'] }}</p><span class="item-value">%</span>
                  </div>
                </div>
                <div class="d-flex border-top card-bottom-box">
                  <div class="bottom-text-box">
                    <div class="d-flex px-2 border-bottom card-bottom-item">
                      <p class="item-title">物件価格</p>
                      <p class="ml-auto item-value">{{ $calculate['property_price'] }}</p><span class="item-value">万円</span>
                    </div>
                    <div class="d-flex px-2 card-bottom-item">
                      <p class="item-title">税引き前CF</p>
                      <p class="ml-auto item-value minus-check calc_before_tax_CF" id="">{{ $calculate['before_tax_CF'] }}</p><span class="item-value">万円</span>
                    </div>
                    @if (isset($calculate['note']))
                    <div class="note-item px-2 pb-2">
                      <p>
                      {{ $calculate['note'] }}
                      </p>
                    </div>
                    @endif
                  </div>
                  <div class="border-left bottom-image-box">
                    <div class="p-2 image-box">
                      @if (isset($calculate['image_path']))
                      <img src='{{ asset("/storage/$calculate[image_path]") }}' class="card-image">
                      @else
                      <div class="text-center d-inline-block p-2 image-none">No <br>image</div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          @endforeach
          @endif
        </div>
        
        <div class="paginate pb-3 mt-2 pb-md-0 my-md-0">
          {{ $calculates->links() }}
        </div>

      </div>
    </div>

  </main>

  <div id="mask"></div>

  <div class="image-detail px-1 hidden" id="image-detail"></div>

  @if ($ad_bottom != null)
  <div class="ad-display mx-auto my-4 my-md-4 text-center container">
    <a href="{{ $ad_bottom->link }}" target="_blank" rel="nofollow noopener" class="d-inline-block mx-auto"><img src="{{ asset($ad_bottom->file_path) }}"></a>
  </div>
  @endif

  <a href="#header" class="return-top_btn hidden">
    <i class="fas fa-chevron-up"></i>
  </a>

  @include('layouts.footer')
@endsection
