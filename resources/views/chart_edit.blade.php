@extends('layouts.layout')
@section('site_title', '編集')
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
          <input type="number" name="property_price" id="property_price" class="rounded border-0 input-item py-2 pl-2 pr-3" placeholder="入力してください" value="{{ $chart->property_price }}" pattern="^([1-9]\d*|0)(\.\d+)?$" required><span class="ml-1 d-inline-block">万円</span>
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
          <input type="number" name="purchase_fee" id="purchase_fee" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->purchase_fee }}"><span class="ml-1 d-inline-block">%</span>
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
          <p class="ml-auto minus-check" id="total_purchase">0.0</p><span class="ml-3 d-inline-block">万円</span>
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
          <input type="number" name="borrowing_amount" id="borrowing_amount" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->borrowing_amount }}"><span class="ml-1 d-inline-block">万円</span>
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
          <p class="ml-auto minus-check" id="own_resources">0.0</p><span class="ml-3 d-inline-block">万円</span>
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
          <input type="number" name="annual_interest" id="annual_interest" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->annual_interest }}"><span class="ml-1 d-inline-block">%</span>
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
          <input type="number" name="borrowing_period" id="borrowing_period" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->borrowing_period }}"><span class="ml-1 d-inline-block">年</span>
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
          <p class="ml-auto minus-check" id="annual_repayment_amount">0.0</p><span class="ml-3 d-inline-block">万円</span>
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
          <p class="ml-auto minus-check" id="total_repayment">0.0</p><span class="ml-3 d-inline-block">万円</span>
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
          <input type="number" name="monthly_rent_income" id="monthly_rent_income" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->monthly_rent_income }}"><span class="ml-1 d-inline-block">万円</span>
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
          <p class="ml-auto minus-check" id="annual_rent_income">1200.0</p><span class="ml-3 d-inline-block">万円</span>
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
          <input type="number" name="expense" id="expense" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->expense }}"><span class="ml-1 d-inline-block">%</span>
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
          <input type="number" name="vacancy" id="vacancy" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->vacancy }}"><span class="ml-1 d-inline-block">%</span>
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
          <p class="ml-auto minus-check" id="annual_take_home">720.0</p><span class="ml-3 d-inline-block">万円</span>
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
          <p class="ml-auto accent pl-1 minus-check" id="surface_yield">0.0</p><span class="ml-3 d-inline-block">%</span>
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
          <p class="ml-auto accent pl-1 minus-check" id="real_yield">0.0</p><span class="ml-3 d-inline-block">%</span>
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
          <p class="ml-auto accent pl-1 minus-check" id="before_tax_CF">0.0</p><span class="ml-3 d-inline-block">万円</span>
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
          <input type="number" name="tax" id="tax" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->tax }}"><span class="ml-1 d-inline-block">%</span>
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
          <p class="ml-auto minus-check" id="after_tax_CF">0.0</p><span class="ml-3 d-inline-block">万円</span>
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
          <input type="number" name="ownership_period" id="ownership_period" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->ownership_period }}"><span class="ml-1 d-inline-block">年</span>
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
          <input type="number" name="sale_price" id="sale_price" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->sale_price }}"><span class="ml-1 d-inline-block">万円</span>
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
          <input type="number" name="sale_commission" id="sale_commission" class="rounded border-0 input-item py-2 px-3" value="{{ $chart->sale_commission }}"><span class="ml-1 d-inline-block">%</span>
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
          <p class="ml-auto pl-1 minus-check" id="transfer_income_tax">0.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label>売却総額 <span class="material-icons-outlined question-icon">help_outline</span>
            <div class="question-content hidden rounded">
              <h3 class="question-title pb-2 pt-1 minus-check">売却総額</h3>
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
          <p class="ml-auto pl-1 minus-check" id="cumulative_after_tax_CF">0.0</p><span class="ml-3 d-inline-block">万円</span>
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
          <p class="ml-auto pl-1 minus minus-check" id="include_sale_cumulative_after_tax_CF">-310.0</p><span class="ml-3 d-inline-block">万円</span>
        </div>
      </div>
      <div class="form-item p-3 p-md-4">
        <h1 class="heading_title pt-2 mb-4">オプション項目</h1>
        @if (isset($chart_option->property_name))
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label for="property_name">物件名</label>
          <input type="text" name="property_name" id="property_name" class="rounded border-0 input-item py-2 px-3 text-left" value="{{ $chart_option->property_name }}">
        </div>
        @else
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label for="property_name">物件名</label>
          <input type="text" name="property_name" id="property_name" class="rounded border-0 input-item py-2 px-3 text-left" value="">
        </div>
        @endif
        @if (isset($chart_option->age))
        <div class="d-flex justify-content-between mb-3 pb-3 pb-md-5 border-bottom">
          <label for="age">築年数</label>
          <input type="number" name="age" id="age" value="{{ $chart_option->age }}" class="rounded border-0 input-item py-2 px-3"><span class="ml-1 d-inline-block">年</span>
        </div>
        @else
        <div class="d-flex justify-content-between mb-3 pb-3 pb-md-5 border-bottom">
          <label for="age">築年数</label>
          <input type="number" name="age" id="age" value="" class="rounded border-0 input-item py-2 px-3"><span class="ml-1 d-inline-block">年</span>
        </div>
        @endif
        @if (isset($chart_option->note))
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label for="note">メモ</label>
          <textarea name="note" id="note" maxlength="200" class="rounded border-0 input-item py-2 px-3 text-left">{{ $chart_option->note }}</textarea>
        </div>
        @else
        <div class="d-flex justify-content-between mb-3 mb-md-4 pb-3 pb-md-5 border-bottom">
          <label for="note">メモ</label>
          <textarea name="note" id="note" maxlength="200" class="rounded border-0 input-item py-2 px-3 text-left"></textarea>
        </div>
        @endif
        
        <div class="d-flex justify-content-between image-form pb-3 pb-md-4 ">
          <label>画像</label>
          <div class="images">

            @if (isset($image1))
            <?php $image1_path = $image1->image_path; ?>
            <label for="image1" class="text-center d-inline-block p-2 p-md-3 ml-md-2 option-image-label hidden">No <br>image</label>
            <div class="image-view d-inline-block mr-1 ml-md-2" id="image-view1">
              <img src='{{ asset("/storage/$image1_path") }}' class="review-image" id="review-image1">
              <span class="fas fa-times-circle d-inline-block delete1"></span>
            </div>
            <input type="file" name="image1" id="image1" class="option-image">
            @else
            <label for="image1" class="text-center d-inline-block p-2 p-md-3 ml-md-2 option-image-label">No <br>image</label>
            <div class="image-view d-inline-block mr-1 hidden ml-md-2" id="image-view1"></div>
            <input type="file" name="image1" id="image1" class="option-image">
            @endif
            <input type="hidden" name="image_location1" value=1>
            <input type="hidden" id="change_flag1" name="change_flag1" value=0>

            @if (isset($image2))
            <?php $image2_path = $image2->image_path; ?>
            <label for="image2" class="text-center d-inline-block p-2 p-md-3 ml-md-2 option-image-label hidden">No <br>image</label>
            <div class="image-view d-inline-block mr-1 ml-md-2" id="image-view2">
              <img src='{{ asset("/storage/$image2_path") }}' class="review-image" id="review-image2">
              <span class="fas fa-times-circle d-inline-block delete2"></span>
            </div>
            <input type="file" name="image2" id="image2" class="option-image">
            @else
            <label for="image2" class="text-center d-inline-block p-2 p-md-3 ml-md-2 option-image-label">No <br>image</label>
            <div class="image-view d-inline-block mr-1 ml-md-2 hidden" id="image-view2"></div>
            <input type="file" name="image2" id="image2" class="option-image">
            @endif
            <input type="hidden" name="image_location2" value=2>
            <input type="hidden" id="change_flag2" name="change_flag2" value=0>

            @if (isset($image3))
            <?php $image3_path = $image3->image_path; ?>
            <label for="image3" class="text-center d-inline-block p-2 p-md-3 ml-md-2 option-image-label hidden">No <br>image</label>
            <div class="image-view d-inline-block mr-1 ml-md-2" id="image-view3">
              <img src='{{ asset("/storage/$image3_path") }}' class="review-image" id="review-image3">
              <span class="fas fa-times-circle d-inline-block delete3"></span>
            </div>
            <input type="file" name="image3" id="image3" class="option-image">
            @else
            <label for="image3" class="text-center d-inline-block p-2 p-md-3 ml-md-2 option-image-label">No <br>image</label>
            <div class="image-view d-inline-block mr-1 ml-md-2 hidden" id="image-view3"></div>
            <input type="file" name="image3" id="image3" class="option-image">
            @endif
            <input type="hidden" name="image_location3" value=3>
            <input type="hidden" id="change_flag3" name="change_flag3" value=0>

          </div>
        @if (Auth::check())
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        @endif
      </div>

      <div class="form-item user-support border-top py-4">
        <div class="d-flex justify-content-around align-content-center">
          <a href="#" onclick="window.print(); return false;" class="btn btn-sm p-2 shadow-sm choice print d-inline-block">ページの印刷</a>
          <button type="submit" name="pdf" value="pdf" class="btn btn-sm p-2 choice save shadow-sm d-inline-block" formaction="/createPDF">PDFで出力</button>
          @if (Auth::check())
          <button type="submit" name="save" value="save" class="btn btn-sm p-2 choice save shadow-sm d-inline-block" formaction="/calc_update/{{ $chart->id }}">データの更新</button>
          @endif
        </div>
      </div>
      <div class="fixed-bottom user-support-fixed hidden">
        <div class="d-flex justify-content-around align-content-center">
          <a href="#" onclick="window.print(); return false;" class="btn btn-sm p-2 choice print d-inline-block">ページの印刷</a>
          <button type="submit" name="pdf" value="pdf" class="btn btn-sm p-2 choice save d-inline-block" formaction="/createPDF">PDFで出力</button>
          @if (Auth::check())
          <button type="submit" name="save" value="save" class="btn btn-sm p-2 choice save d-inline-block" formaction="/calc_update/{{ $chart->id }}">データの更新</button>
          @endif
        </div>
      </div>
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

  @include('layouts.footer')
@endsection
