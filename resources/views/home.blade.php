@extends('layouts.layout')
@section('site_title', 'ホーム')
@section('content')
  <section class="container heading py-4" id="heading">
    <h1 class="mb-4">不動産投資利回りシミュレーション</h1>
    <p>不動産物件に関する情報を入力してください。</p>
    <p>下部に自動的に利回りシミュレーション結果が表示されます。</p>
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

  <section class="container-fluid mx-auto p-0 pb-3 pb-md-4 main-tool">
    <form method="POST" enctype="multipart/form-data">
    @csrf
      <div class="form-item p-3 p-md-4">
        <h1 class="heading_title mb-4">購入価格項目を入力してください。</h1>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>物件価格 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">物件価格</h3>
              <div class="question-text">
                <p>物件の購入価格を入力してください。</p>
              </div>
            </div>
          </label>
          <input type="number" name="property_price" id="property_price" class="rounded border-0 input-item py-2 pl-2 pr-3" placeholder="入力してください" step="0.1" pattern="^([1-9]\d*|0)(\.\d+)?$" required><span class="ml-1 d-inline-block">万円</span>
        </div>

        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>購入手数料 <span class="material-icons-outlined question-icon">help_outline</span>
          <div class="question-content hidden rounded">
            <h3 class="question-title pb-2 pt-1">購入手数料</h3>
            <div class="question-text scroll-box">
              <p>
                新築は物件価格の４〜６％、中古は７〜１０％ほど。
              </p>
              <p class="mt-2">
                <ul>
                  <li>・不動産仲介手数料</li>
                  <li>・不動産投資ローン事務手数料</li>
                  <li>・不動産投資ローン保証料</li>
                  <li>・火災保険料</li>
                  <li>・印紙代</li>
                  <li>・登録免許税</li>
                  <li>・司法書士報酬</li>
                  <li>・不動産取得税</li>
                  <li>・固定資産税、都市計画税</li>
                </ul>
              </p>
            </div>
          </div>
          </label>
          <input type="number" name="purchase_fee" id="purchase_fee" class="rounded border-0 input-item py-2 px-3" value="10.0" step="0.1"><span class="ml-1 d-inline-block">%</span>
        </div>
        <div class="d-flex justify-content-between">
          <label>購入総額 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">購入総額</h3>
              <div class="question-text">
                <p>物件価格に購入手数料を足した総額</p>
              </div>
            </div>
          </label>
          <p class="ml-auto" id="total_purchase">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
      </div>
      <div class="form-item p-3 p-md-4">
        <h1 class="heading_title pt-2 mb-4">資金項目を入力してください。</h1>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>借入金額 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">借入金額</h3>
              <div class="question-text">
                <p>
                  物件購入のための借入金額を入力してください。
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="borrowing_amount" id="borrowing_amount" class="rounded border-0 input-item py-2 px-3" value=0.0 step="0.1"><span class="ml-1 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>自己資金 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">自己資金</h3>
              <div class="question-text">
                <p>
                  購入総額から借入金額を引いた金額です。
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto" id="own_resources">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>年間利息 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">年間利息</h3>
              <div class="question-text">
                <p>
                  借入金額の年間利息を入力してください。
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="annual_interest" id="annual_interest" class="rounded border-0 input-item py-2 px-3" value=0.0 step="0.1"><span class="ml-1 d-inline-block">%</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>借入期間 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">借入期間</h3>
              <div class="question-text">
                <p>
                  借入の返済期間を入力してください。
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="borrowing_period" id="borrowing_period" class="rounded border-0 input-item py-2 px-3" value=35.0 step="0.1"><span class="ml-1 d-inline-block">年</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-55 border-bottom">
          <label>年間元利返済額 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">年間元利返済額</h3>
              <div class="question-text">
                <p>
                  元利均等返済 で計算しています。
                </p>
                <p class="mt-2">
                  12 × ((借入金額 × (年間利息 / 12) × (1 + (年間利息 / 12)) ^ (借入期間 × 12)) / ((1 + (年間利息 / 12)) ^ (借入期間 × 12)))
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto" id="annual_repayment_amount">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between">
          <label>返済総額 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">返済総額</h3>
              <div class="question-text">
                <p>
                  借入期間 × 年間元利返済額 です。
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto" id="total_repayment">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
      </div>
      <div class="form-item p-3 p-md-4">
        <h1 class="heading_title pt-2 mb-4">キャッシュフロー単年項目を入力してください。</h1>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>月家賃収入 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">月家賃収入</h3>
              <div class="question-text">
                <p>
                  月当たりの家賃収入額を入力してください。
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="monthly_rent_income" id="monthly_rent_income" class="rounded border-0 input-item py-2 px-3" value=100.0 step="0.1"><span class="ml-1 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 pb-3 pb-md-5 border-bottom">
          <label>年間家賃収入 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">年間家賃収入</h3>
              <div class="question-text">
                <p>
                  月家賃収入 × １２ヶ月分 です。
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto" id="annual_rent_income">1200.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>経費率 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">経費率</h3>
              <div class="question-text scroll-box">
                <p>
                  年間家賃料の１０％〜３０％ほどが目安。築年数が経つほど上がっていく。
                </p>
                <p class="mt-2">
                  修繕費、清掃費、管理会社への委託費用、入居時の広告費やエレベーターのメンテナンス費、消防点検などの法定費用、除草などの環境維持費用<br>年ごとで固定資産税や都市計画税などの税金や保険料なども。
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="expense" id="expense" class="rounded border-0 input-item py-2 px-3" value=30.0 step="0.1"><span class="ml-1 d-inline-block">%</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>空室率 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">空室率</h3>
              <div class="question-text">
                <p>
                  立地や物件によって異なりますが１０％〜３０％程、地域ごとの空室率はネットでも調べることができます。
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="vacancy" id="vacancy" class="rounded border-0 input-item py-2 px-3" value=10.0 step="0.1"><span class="ml-1 d-inline-block">%</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>年間手取り <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">年間手取り</h3>
              <div class="question-text">
                <p>
                  年間家賃から経費分と空室分を差し引いたもの。<br>
                  年間家賃収入 × (100 - 経費率 - 空室率)
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto" id="annual_take_home">720.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>表面利回り <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">表面利回り</h3>
              <div class="question-text">
                <p>
                  グロスとも呼ばれる、年間家賃収入を購入総額で割った数字です。投資物件を探す際に、最初の目安となります。<br>
                  <br>
                  年間家賃収入 ÷ 購入総額
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto accent pl-1" id="surface_yield">0.0</p><span class="ml-3 d-inline-block">%</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>実質利回り <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">実質利回り</h3>
              <div class="question-text">
                <p>
                  ネットとも呼ばれる、年間家賃収入から経費や空室分を差し引いた実質年間手取りを購入総額で割った数字です。より正確な収益力を判断するための指標となります。<br>
                  <br>
                  年間手取り ÷ 購入総額
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto accent pl-1" id="real_yield">0.0</p><span class="ml-3 d-inline-block">%</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>税引き前CF <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">税引き前CF</h3>
              <div class="question-text">
                <p>
                  CF = キャッシュフロー です。<br>
                  年間手取り - 年間元利返済額
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto accent pl-1" id="before_tax_CF">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label class="tax">税率<span class="tax-option ml-1">(所得税、住民税)</span> <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">税率</h3>
              <div class="question-text">
                <p>
                  税率を入力してください。<br>
                  所得税５〜４５％、住民税１０％程度が目安です。
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="tax" id="tax" class="rounded border-0 input-item py-2 px-3" value=30.0 step="0.1"><span class="ml-1 d-inline-block">%</span>
        </div>
        <div class="d-flex justify-content-between">
          <label>税引き後CF <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">税引き後CF</h3>
              <div class="question-text">
                <p>
                  税引き前CF - 税率(所得税、住民税)
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto" id="after_tax_CF">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
      </div>
      <div class="form-item p-3 p-md-4">
        <h1 class="heading_title pt-2 mb-4">キャッシュフロー累計項目を入力してください。</h1>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>所有期間 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">所有期間</h3>
              <div class="question-text">
                <p>
                  物件の所有予定期間を入力してください。
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="ownership_period" id="ownership_period" class="rounded border-0 input-item py-2 px-3" value=35.0 step="0.1"><span class="ml-1 d-inline-block">年</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>売却価格 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">売却価格</h3>
              <div class="question-text">
                <p>
                  物件の売却予定価格を入力してください。
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="sale_price" id="sale_price" class="rounded border-0 input-item py-2 px-3" value=2.0 step="0.1"><span class="ml-1 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>売却手数料率 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">売却手数料率</h3>
              <div class="question-text scroll-box">
                <p>
                  以下のようなものがあります。
                  <ul>
                    <li>・仲介手数料 ３％ + ６万円</li>
                    <li>・印紙代 (売買契約書に課税)</li>
                    <li>・登記費用 (抵当権抹消などの費用、司法書士報酬)</li>
                    <li>・その他の必要の応じて支払う費用 (測量費、解体費、廃棄物処分費など)</li>
                    <li>・引越し費用</li>
                  </ul>
                </p>
              </div>
            </div>
          </label>
          <input type="number" name="sale_commission" id="sale_commission" class="rounded border-0 input-item py-2 px-3" value=3.0 step="0.1"><span class="ml-1 d-inline-block">%</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>譲渡所得税 <span class="material-icons-outlined question-icon">help_outline</span>
          <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">譲渡所得税</h3>
              <div class="question-text scroll-box">
                <p>
                  税率は、以下のとおりで計算しています。
                </p>
                <p class="mt-2">
                  所有期間５年未満 (短期所有) :<br>
                  所得税３０.６３％、住民税９％<br>
                  所得期間５年以上 (長期所有) :<br>
                  所得税１５.３１５％、住民税５％<br>
                  ※復興特別所得税(基準所得税額 × 2.1％)は省略しています。
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto pl-1" id="transfer_income_tax">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>売却総額 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">売却総額</h3>
              <div class="question-text">
                <p>
                  売却価格 - 売却手数料率 - 譲渡所得税
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto pl-1" id="total_sale">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>税引き後CF累計 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">税引き後CF累計</h3>
              <div class="question-text">
                <p>
                  税引き後CF × 所有期間
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto pl-1" id="cumulative_after_tax_CF">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between">
          <label class="cumulative_tax">税引き後CF累計<span class="tax-option">(売却含む)</span><br><span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1">税引き後CF累計 (売却含む)</h3>
              <div class="question-text">
                <p>
                  税引き後CF + 売却総額 - 購入総額
                </p>
              </div>
            </div>
          </label>
          <p class="ml-auto pl-1 minus" id="include_sale_cumulative_after_tax_CF">-310.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
      </div>
      <div class="form-item p-3 p-md-4">
        <h1 class="heading_title pt-2 mb-4">オプション項目</h1>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label for="property_name">物件名</label>
          <input type="text" name="property_name" id="property_name" class="rounded border-0 input-item py-2 px-3 text-left" value="新規物件A">
        </div>
        <div class="d-flex justify-content-between mb-3 pb-3 pb-md-5 border-bottom">
          <label for="age">築年数</label>
          <input type="number" name="age" id="age" step="0.1" class="rounded border-0 input-item py-2 px-3"><span class="ml-1 d-inline-block">年</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label for="note">メモ</label>
          <textarea name="note" id="note" maxlength="200" class="rounded border-0 input-item py-2 px-3 text-left"></textarea>
        </div>
        <div class="d-flex justify-content-between image-form pb-3 pb-md-4 ">
          <label for="note">画像</label>
          <div class="images">

            <label for="image1" class="text-center d-inline-block p-2 p-md-3 ml-md-2 option-image-label">No <br>image</label>
            <div class="image-view d-inline-block ml-1 hidden" id="image-view1"></div>
            <input type="hidden" name="image_location1" value=1>
            <input type="file" name="image1" id="image1" class="option-image">
            

            <label for="image2" class="text-center d-inline-block p-2 p-md-3 ml-md-2 option-image-label">No <br>image</label>
            <div class="image-view d-inline-block ml-1 hidden" id="image-view2"></div>
            <input type="hidden" name="image_location2" value=2>
            <input type="file" name="image2" id="image2" class="option-image">

            <label for="image3" class="text-center d-inline-block p-2 p-md-3 ml-md-2 option-image-label">No <br>image</label>
            <div class="image-view d-inline-block ml-1 hidden" id="image-view3"></div>
            <input type="hidden" name="image_location3" value=3>
            <input type="file" name="image3" id="image3" class="option-image">

          </div>
        @if (Auth::check())
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        @endif
      </div>

      <div class="form-item user-support border-top py-4">
        <div class="d-flex justify-content-around align-content-center">
          @if (!$isMobile)
          <button type="submit" name="pdf" value="pdf" class="btn btn-sm p-2 choice save shadow-sm d-inline-block" formaction="/createPDF">PDFで出力</button>
          @endif
          @if (Auth::check())
          <button type="submit" name="save" value="save" class="btn btn-sm p-2 choice save shadow-sm d-inline-block" formaction="/calc_store">データを保存</button>
          @endif
        </div>
      </div>
      @if (!$isMobile || Auth::check())
      <div class="fixed-bottom user-support-fixed hidden">
        <div class="d-flex justify-content-around align-content-center">
          @if (!$isMobile)
          <button type="submit" name="pdf" value="pdf" class="btn btn-sm p-2 choice save d-inline-block" formaction="/createPDF">PDFで出力</button>
          @endif
          @if (Auth::check())
          <button type="submit" name="save" value="save" class="btn btn-sm p-2 choice save d-inline-block" formaction="/calc_store">データを保存</button>
          @endif
        </div>
      </div>
      @endif
    </form>
  </section>

  <div id="mask"></div>

  <div class="image-detail px-1 hidden" id="image-detail"></div>

  @if ($ad_bottom != null)
  <div class="ad-display mx-auto mb-3 mb-md-4 text-center container">
    <a href="{{ $ad_bottom->link }}" target="_blank" rel="nofollow noopener" class="d-inline-block mx-auto"><img src="{{ asset($ad_bottom->file_path) }}"></a>
  </div>
  @endif

  <a href="#header" class="return-top_btn hidden">
    <i class="fas fa-chevron-up"></i>
  </a>

  <div class="contents-outline pt-5">

    <section class="container-fluid mx-auto p-0 pb-3 pb-md-4 contents-area">
      <h1 class="entry-title">【不動産投資】利回りシミュレーションツールの使い方</h1>
      <div class="ad-area border pl-1 py-2 mb-4 d-flex rounded">
        <a href="https://c.hskr.info/appadtech/a.php?id=c63d1c566d796201443c3914213264f4" class="d-inline-block mr-1 mr-sm-2 pt-5 pt-sm-0">
          <img src="https://hskr.info/wp-content/uploads/2020/06/renosy_1.png">
        </a>
        <div class="ad-area-right">
          <h4 class="ad-feature mb-1"><span class="fas fa-check"></span> リノシーの特徴</h3>
          <p class="mb-1">● 入居率約９９％の堅実な収益</p>
          <p class="mb-1">● AIによる不動産投資物件紹介</p>
          <p class="mb-1">● 無料面談でギフト券もらえる</p>
          <p class="text-right"><a href="https://c.hskr.info/appadtech/a.php?id=c63d1c566d796201443c3914213264f4" target="_brank" rel="nofollow">&gt;&gt; 公式サイトはこちら</a></p>
        </div>
      </div>
  
      <p>
        不動産投資利回りシミュレーションは、必要な項目を入力するだけで、自動で利回りやキャッシュフローを計算できる便利ツールです。
      </p>
      <p>
        各項目の解説とあわせて、利回り計算ツールの使い方をご紹介します。
      </p>
  
      <a href="https://fudosan.fctry.net/" class="simulatar-link mx-auto mb-4" target="_blank">シミュレーターを使ってみる<span class="fas fa-external-link-alt"></span></a>
  
      <div class="table-contents">
        <p class="text-center mb-0">目次<span>[<a href="#" data-toggle="collapse" data-target="#childMenuItem1" aria-expanded="true" id="collapsible" aria-controls="childMenuItem1">非表示</a>]</span></p>
        <ul class="table-contents-list collapse show mt-2" id="childMenuItem1">
          <li>
            <a href="#i">不動産投資利回りシミュレーションとは</a>
            <ul>
              <li>
                <a href="#i-2">シミュレーションの概要と重要性</a>
              </li>
              <li>
                <a href="#i-3">利回りシミュレーションの注意点</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#i-4">不動産投資シミュレーションの使い方</a>
          </li>
          <li>
            <a href="#i-5">表面利回りと実質利回りの計算方法と例</a>
            <ul>
              <li><a href="#i-6">表面利回り</a></li>
              <li><a href="#i-7">実質利回り</a></li>
              <li><a href="#i-8">利回りの計算方法</a></li>
            </ul>
          </li>
          <li><a href="#i-9">印刷して活用しよう</a></li>
        </ul>
      </div>
  
      <h2>
        {{-- before::  --}}
        <span id="i">不動産投資利回りシミュレーションとは</span>
        {{-- after::  --}}
      </h2>
  
      <p>
        <img src="https://hskr.info/wp-content/uploads/2021/05/計算機_01.png">
      </p>
  
      <h3>
        <span id="i-2"> 
          <i class="fas fa-check-circle"></i>
        </span>
        <span>
          シミュレーションの概要と重要性
        </span>
      </h3>
  
      <p>
        不動産投資で収益をあげるためには、投資物件の見極めが重要です。
      </p>
      <p>
        <b>
          そのためには毎月の家賃収入だけでなく、返済や税金などといった必要経費を考慮したあとに手元に残るCF（キャッシュフロー）を試算する必要があります。
        </b>
      </p>
      <p>
        また不動産は経年とともに評価額や入居率の低下など、収入減のリスクは増えていくものです。
      </p>
      <p>
        このシミュレーションツールは、購入前に投資物件の利回りをできるだけ具体的にシミュレーションしておくことで、安定した資産形成につなげることを目的としています。
      </p>
  
      <h3>
        <span id="i-3"> 
          <i class="fas fa-check-circle"></i>
        </span>
        <span>
          利回りシミュレーションの注意点
        </span>
      </h3>
  
      <p>
        <b>
          できる限り具体的な数字を試算しても、現実は必ずしもその通りになるわけではありません。
        </b>
      </p>
  
      <p>
        契約上の細かい条件や、社会情勢の変化、入居率の変動など、想定不可能な要素によって変動する可能性があることは大前提として、あくまでシミュレーション（想定）と割り切って数字をとらえておくようにしましょう。
      </p>
  
      <h2>
        {{-- before::  --}}
        <span id="i-4">不動産投資シミュレーションの使い方</span>
        {{-- after::  --}}
      </h2>
  
      <p>
        不動産投資のシミュレーションは、必要な数字を項目に入力するだけで自動で計算してくれます。
      </p>
      <p>
        主な項目と内容について、下記の表をご参考ください。
      </p>
  
      <table>
        <thead>
          <tr>
            <th>項目</th>
            <th>内容と説明</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>購入価格項目</td>
            <td>
              購入金額の他、手数料も入力して総額を算出します。<br />
              手数料の目安は新築なら4~6%、中古なら7~10%です。
            </td>
          </tr>
          <tr>
            <td>資金項目</td>
            <td>
              借入金額や、利息などの住宅ローンの情報を入力します。<br />
              金利には固定金利と変動金利があり、変動金利方の場合は目安を入力してください。
            </td>
          </tr>
          <tr>
            <td>キャッシュフロー単年項目</td>
            <td>
              賃貸する際の月額家賃や経費率を入力します。<br />
              経費率は家賃の10~30%が目安で、築年数に比例します。<br />
              空室率は10%~30%ですが、地域差がありますのでネットで調べてより現実的な数字を入れましょう。
            </td>
          </tr>
          <tr>
            <td>キャッシュフロー累計項目</td>
            <td>
              売却価格は、売却予定時の築年数で同条件のマンション価格を調べて参考にしましょう。<br />
              売却手数料には印紙代や登記手数料、仲介手数料などが含まれます。
            </td>
          </tr>
          <tr>
            <td>オプション項目 </td>
            <td>
              複数の物件の利回りを比較しやすいように、物件名や画像などの物件情報を残しておきましょう。
            </td>
          </tr>
        </tbody>
      </table>
  
      <h2>
        {{-- before::  --}}
        <span id="i-5">表面利回りと実質利回りの計算方法と例</span>
        {{-- after::  --}}
      </h2>
  
      <p><b>不動産投資の利回りには、表面利回りと実質利回りの2種類があります。</b></p>
      <p>
        投資物件の広告には表面利回りしか載っていないことが多いので、必ず実質利回りを計算するようにしましょう。
      </p>
  
      <h3>
        <span id="i-6">
          <i class="fas fa-check-circle"></i>
        </span>
        <span>
          表面利回り
        </span>
      </h3>
  
      <p>
        <img src="https://hskr.info/wp-content/uploads/2019/03/hesokuri_20190531_bunchu_640x300_012.png">
      </p>
  
      <p>
        表面利回りは、別名グロス利回りとも言われ、物件が持つだいたいの収益力を見るのに便利な簡易的な利回り計算方法です。
      </p>
  
      <div class="border mt-0 supplement">
        想定年間家賃収入÷物件の購入価格×100
      </div>
  
      <h3>
        <span id="i-7">
          <i class="fas fa-check-circle"></i>
        </span>
        <span>
          実質利回り
        </span>
      </h3>
  
      <p>
        <img src="https://hskr.info/wp-content/uploads/2019/03/hesokuri_20190531_bunchu_640x300_013.png">
      </p>
  
      <p>
        表面利回りとは異なり、固定資産税や管理費、保険料や修繕費用など不動産運営にかかる経費を含めて算出しているのが実質利回りです。
      </p>
  
      <div class="border mt-0 supplement">
        （想定年間家賃収入－年間経費）÷（物件価格＋購入時諸費用）×100
      </div>
  
      <h3>
        <span id="i-8">
          <i class="fas fa-check-circle"></i>
        </span>
        <span>
          利回りの計算例
        </span>
      </h3>
  
      <p>実際の数字を当てはめてみましょう。</p>
  
      <div class="border mt-0 supplement">
        <p class="mb-0">
          <b style="color: orange;">●</b> <b>利回り計算条件</b> <br />
          投資物件購入価格（物件価格）：3,000万円 <br />
          年間家賃収入：144万円（12万円/月） <br />
          年間諸経費：70万円
        </p>
      </div>
  
      <p>
        <img src="https://hskr.info/wp-content/uploads/2019/03/hesokuri_20190531_bunchu_640x300_014.png">
      </p>
  
      <p>実質利回りに比べて表面利回りでは倍の利回りになっています。</p>
  
      <p>シミュレーターを使って、より現実的な想定利回りを把握しておきましょう。</p>
  
      <h2>
        {{-- before::  --}}
        <span id="i-9">印刷して活用しよう</span>
        {{-- after::  --}}
      </h2>
      <p><b>不動産投資では、必ず投資物件が利益を出せる不動産かどうか確認してから購入しましょう。</b></p>
      <p>
        すでに所有している投資物件のキャッシュフローを確認したり、購入を検討している不動産の利回りを比較したりと、資産形成のお役立ちツールとして活用ください。
      </p>
  
      <a href="https://fudosan.fctry.net/" class="simulatar-link mx-auto mb-4" target="_blank">シミュレーターを使ってみる<span class="fas fa-external-link-alt"></span></a>
  
      <div class="recommend-box">
        <p class="str-orange text-center mb-1">不動産投資の情報収集を始めよう！</p>
        <p class="text-center">
          <a href="https://c.hskr.info/appadtech/a.php?id=c63d1c566d796201443c3914213264f4" target="_blank" rel="nofollow noopener" class="inline-block text-center">
            <img src="https://hskr.info/wp-content/uploads/2020/06/renosy_1.png" class="d-inline-block" alt="マンションオーナー">
          </a>
        </p>
        <p class="mb-1">無料で<b class="str-orange">DVDとオリジナルブック</b>がもらえる！</p>
        <p class="mb-1">
          <b class="str-orange">● </b>入居率約99%の堅実な収益 <br />
          <b class="str-orange">● </b>AIによる不動産投資物件紹介 <br />
          <b class="str-orange">● </b>無料面談でギフト券もらえる <br />
        </p>
        <p class="mb-0"><a href="https://c.hskr.info/appadtech/a.php?id=c63d1c566d796201443c3914213264f4" target="_blank" rel="nofollow noopener">→無料で資料請求する<span class="fas fa-external-link-alt"></span></a></p>
      </div>
    </section>
  </div>

  @include('layouts.footer')
  <script type="text/javascript">
    function handleClick()
    {
      this.text = (this.text == '非表示' ? '表示' : '非表示');
    }
    document.getElementById('collapsible').onclick=handleClick;
  </script>
@endsection
