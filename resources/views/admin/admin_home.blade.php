@extends('admin_layouts.admin_layout')
@section('site_title', '管理者ページ')
@section('content')
<div class="right_col" role="main">
  <div class="">
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
            <h2>広告１( 上 ) 画像・リンク選択</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link ml-5"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p>広告１( 上 ) の画像とリンクのURLを入力してください。</p>
            <form action="form_upload.html" class="pt-3 pb-2 border">
              @csrf
              <div class="dz-default dz-message mx-3 mb-3">
                <label for="image1" class="select-img btn d-block shadow-sm mb-4">画像１を選択する</label>
                <input type="file" name="image1" id="image1" value="画像を選択してください。" accept="image/png, image/jpeg" required>
                <div id="image-content" style="background: orange; height: 80px;">画像を選択したら表示する</div>
              </div>
              <div class="form-group mx-3 mb-3">
                <label for="ad-link1">広告１のURLを入力してください。</label>
                <input type="text" name="ad-link" id="ad-link1" class="form-control rounded">
              </div>
              <div class="form-group text-right mr-3">
                <input type="submit" value="適用する" class="btn d-inline-block shadow-sm">
              </div>
            </form>
            <br />
          </div>
        </div>
        <div class="x_panel">
          <div class="x_title">
            <h2>広告２( 下 ) 画像・リンク選択</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link ml-5"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p>広告２( 下 ) の画像とリンクのURLを入力してください。</p>
            <form action="form_upload.html" class="pt-3 pb-2 border">
              @csrf
              <div class="dz-default dz-message mx-3 mb-3">
                <label for="image2" class="select-img btn d-block shadow-sm mb-4">画像２を選択する</label>
                <input type="file" name="image2" id="image2" value="画像を選択してください。" accept="image/png, image/jpeg" required>
                <div id="image-content" style="background: orange; height: 80px;">画像を選択したら表示する</div>
              </div>
              <div class="form-group mx-3 mb-3">
                <label for="ad-link2">広告２のURLを入力してください。</label>
                <input type="text" name="ad-link" id="ad-link2" class="form-control rounded">
              </div>
              <div class="form-group text-right mr-3">
                <input type="submit" value="適用する" class="btn d-inline-block shadow-sm">
              </div>
            </form>
            <br />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection