<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/5f12186527.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
  <body>
    @include('layouts.header')

    <section class="container heading py-4" id="heading">
      <h1 class="mb-4">不動産投資利回りシミュレーション</h1>
      <p>不動産物件に関する情報を入力してください。</p>
      <p>下部に自動的に利回りシミュレーション結果が表示されます。</p>
    </section>

    <div class="ad-display mx-auto mb-3 mb-md-4 text-center container">
      <a href="{{ $ad_top->link }}" class="d-inline-block mx-auto"><img src="{{ asset($ad_top->file_path) }}"></a>
    </div>

    <section class="container-fluid mx-auto p-0 pb-3 pb-md-4 main-tool">
      <form action="" method="" onsubmit="return false;">
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
            <input type="number" name="property_price" id="property_price" class="rounded border-0 input-item py-2 pl-2 pr-3" placeholder="入力してください" pattern="^([1-9]\d*|0)(\.\d+)?$" required><span class="ml-1 d-inline-block">万円</span>
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
            <input type="number" name="purchase_fee" id="purchase_fee" class="rounded border-0 input-item py-2 px-3" value=10.0><span class="ml-1 d-inline-block">%</span>
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
            <input type="number" name="borrowing_amount" id="borrowing_amount" class="rounded border-0 input-item py-2 px-3" value=0.0><span class="ml-1 d-inline-block">万円</span>
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
            <input type="number" name="annual_interest" id="annual_interest" class="rounded border-0 input-item py-2 px-3" value=0.0><span class="ml-1 d-inline-block">%</span>
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
            <input type="number" name="borrowing_period" id="borrowing_period" class="rounded border-0 input-item py-2 px-3" value=35.0><span class="ml-1 d-inline-block">年</span>
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
            <input type="number" name="monthly_rent_income" id="monthly_rent_income" class="rounded border-0 input-item py-2 px-3" value=100.0><span class="ml-1 d-inline-block">万円</span>
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
            <input type="number" name="expense" id="expense" class="rounded border-0 input-item py-2 px-3" value=30.0><span class="ml-1 d-inline-block">%</span>
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
            <input type="number" name="vacancy" id="vacancy" class="rounded border-0 input-item py-2 px-3" value=10.0><span class="ml-1 d-inline-block">%</span>
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
            <input type="number" name="tax" id="tax" class="rounded border-0 input-item py-2 px-3" value=30.0><span class="ml-1 d-inline-block">%</span>
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
            <input type="number" name="ownership_period" id="ownership_period" class="rounded border-0 input-item py-2 px-3" value=35.0><span class="ml-1 d-inline-block">年</span>
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
            <input type="number" name="sale_price" id="sale_price" class="rounded border-0 input-item py-2 px-3" value=2.0><span class="ml-1 d-inline-block">万円</span>
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
            <input type="number" name="sale_commission" id="sale_commission" class="rounded border-0 input-item py-2 px-3" value=3.0><span class="ml-1 d-inline-block">%</span>
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
            <input type="number" name="age" id="age" class="rounded border-0 input-item py-2 px-3"><span class="ml-1 d-inline-block">年</span>
          </div>
          <div class="d-flex justify-content-between">
            <label for="note">メモ</label>
            <textarea name="note" id="note" maxlength="200" class="rounded border-0 input-item py-2 px-3 text-left"></textarea>
          </div>
        </div>

        <div class="form-item user-support border-top py-4">
          <div class="d-flex justify-content-around align-content-center">
            <a href="#" onclick="window.print(); return false;" class="btn btn-sm p-2 shadow-sm choice print d-inline-block">ページを印刷する</a>
            @if (Auth::check())
              <input type="submit" value="データを保存する" class="btn btn-sm p-2 shadow-sm choice save d-inline-block" onclick="submit();">
            @endif
          </div>
        </div>
        <div class="fixed-bottom user-support-fixed hidden">
          <div class="d-flex justify-content-around align-content-center">
            <a href="#" onclick="window.print(); return false;" class="btn btn-sm p-2 choice print d-inline-block">ページを印刷する</a>
            @if (Auth::check())
              <input type="submit" value="データを保存する" class="btn btn-sm p-2 choice save d-inline-block" onclick="submit();">
            @endif
          </div>
        </div>
      </form>
    </section>

    <div class="ad-display mx-auto mb-3 mb-md-4 text-center container">
      <a href="{{ $ad_bottom->link }}" class="d-inline-block mx-auto"><img src="{{ asset($ad_bottom->file_path) }}"></a>
    </div>

    <a href="#header" class="return-top_btn hidden">
      <i class="fas fa-chevron-up"></i>
    </a>

    @include('layouts.footer')

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <!-- main.js -->
    <script src="{{ mix('js/main.js') }}"></script>
    <!-- input_limit.js -->
    <script src="{{ mix('js/input_limit.js') }}"></script>
    <!-- calculate.js -->
    <script src="{{ mix('js/calculate.js') }}"></script>
  </body>
</html>
