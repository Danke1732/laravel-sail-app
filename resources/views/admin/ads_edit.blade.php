@extends('admin_layouts.admin_layout')
@section('site_title', '管理者ページ')
@section('content')
<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>広告設定 </h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12  ">
      <div class="x_panel mb-3">
        <div class="x_title">
          <h2>広告画像・リンク選択</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link ml-5"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p>広告の画像とリンクのURLを入力してください。</p>
          <form action="{{ route('ads.update') }}" method="POST" class="pt-3 pb-2 border" enctype="multipart/form-data">
            @csrf
            <div class="dz-default dz-message mx-3 mb-3 d-flex flex-column">
              <label for="image">画像URLを入力してください。</label>
              <input type="url" name="image" value="{{ $ad->file_name }}" id="image" placeholder="例）https://***.〇〇〇" class="mb-3 form-control rounded" required>
              <div id="image-content"></div>
            </div>
            <div class="form-group mx-3 mb-3">
              <label for="ad-link">広告のURLを入力してください。</label>
              <input type="text" name="ad-link" id="ad-link" value="{{ $ad->link }}" class="form-control rounded" required>
            </div>
            <input type="hidden" value="{{ $ad->id }}" name="id">
            <input type="hidden" value="{{ $ad->location }}" name="location">
            <div class="form-group text-right mr-3">
              <input type="submit" value="更新する" class="btn d-inline-block shadow-sm">
            </div>
          </form>
          <br />
        </div>
      </div>
    </div>
  </div>
</div>
@endsection