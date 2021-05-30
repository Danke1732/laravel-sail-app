<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PDF | 不動産投資利回りシミュレーションツール｜ローンや経費を一括自動計算</title>
<style>
body {
  font-family: 'メイリオ';
  width: 595px;
  height: 842px;
}
.site-title {
  color: #003d7c;
  font-weight: bold;
  font-size: 18px;
}
.property_name {
  font-size: 14px;
}
.item-title {
  font-weight: bold;
  width: 595px;
}
td {
  height: 12px;
  font-size: 10px;
}

.value {
  text-align: right;
  width: 130px;
}
.long-text {
  width: 127px;
}
.value-special {
  width: 111px;
}
.note-box {
  padding: 8px;
  border: 1px solid #DEE2E6;
}
</style>
</head>
<body>
  <header>
    <h1 class="site-title">不動産投資利回りシミュレーション</h1>
    <div class="property_name">@isset($property_name) {{ $property_name }} @endisset</p>
  </header>

  <main>
    <div class="item-title">購入価格項目&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;資金項目<br /></div>
    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6;">物件価格</td>
          <td class="value" style="border-bottom: 1px solid #DEE2E6">@isset($property_price) {{ $property_price }} @endisset &nbsp;<span>万円</span></td>
          <td style="width: 60px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">借入金額</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($borrowing_amount) {{ $borrowing_amount }} @endisset &nbsp;<span>万円</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">購入手数料</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($purchase_fee) {{ $purchase_fee }} @endisset<span> &nbsp;&nbsp;&nbsp;％</span></td>
          <td style="width: 60px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">自己資金</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($own_resources) {{ $own_resources }} @endisset &nbsp;<span>万円</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">購入総額</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($total_purchase) {{ $total_purchase }} @endisset &nbsp;<span>万円</span></td>
          <td style="width: 60px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">年間利息</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($annual_interest) {{ $annual_interest }} @endisset<span> &nbsp;&nbsp;&nbsp;％</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <table class="item-box">
      <thead>
        <tr>
          <td> </td>
          <td></td>
          <td style="width: 82px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">借入期間</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($borrowing_period) {{ $borrowing_period }} @endisset<span> &nbsp;&nbsp;&nbsp;年</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td> </td>
          <td></td>
          <td style="width: 82px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">年間元利返済額</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($annual_repayment_amount) {{ $annual_repayment_amount }} @endisset &nbsp;<span>万円</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td> </td>
          <td></td>
          <td style="width: 82px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">返済総額</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($total_repayment) {{ $total_repayment }} @endisset &nbsp;<span>万円</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <div class="item-title">キャッシュフロー単年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;キャッシュフロー累計<br /></div>
    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">月家賃収入</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($monthly_rent_income) {{ $monthly_rent_income }} @endisset &nbsp;<span>万円</span></td>
          <td style="width: 60px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">所有期間</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($ownership_period) {{ $ownership_period }} @endisset<span> &nbsp;&nbsp;&nbsp;年</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">年間家賃収入</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($annual_rent_income) {{ $annual_rent_income }} @endisset &nbsp;<span>万円</span></td>
          <td style="width: 60px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">売却価格</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($sale_price) {{ $sale_price }} @endisset &nbsp;<span>万円</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">経費率</td>
          <td class="value" style="border-bottom: 1px solid #DEE2E6">@isset($expense) {{ $expense }} @endisset<span> &nbsp;&nbsp;&nbsp;％</span></td>
          <td style="width: 60px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">売却手数料率</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($sale_commission) {{ $sale_commission }} @endisset<span> &nbsp;&nbsp;&nbsp;％</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">空室率</td>
          <td class="value" style="border-bottom: 1px solid #DEE2E6">@isset($vacancy) {{ $vacancy }} @endisset<span> &nbsp;&nbsp;&nbsp;％</span></td>
          <td style="width: 60px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">譲渡所得税</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($transfer_income_tax) {{ $transfer_income_tax }} @endisset &nbsp;<span>万円</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">年間手取り</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($annual_take_home) {{ $annual_take_home }} @endisset &nbsp;<span>万円</span></td>
          <td style="width: 60px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">売却総額</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($total_sale) {{ $total_sale }} @endisset &nbsp;<span>万円</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">表面利回り</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($surface_yield) {{ $surface_yield }} @endisset<span> &nbsp;&nbsp;&nbsp;％</span></td>
          <td style="width: 60px;"></td>
          <td style="border-bottom: 1px solid #DEE2E6">税引き後CF累計</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($cumulative_after_tax_CF) {{ $cumulative_after_tax_CF }} @endisset &nbsp;<span>万円</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">実質利回り</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($real_yield) {{ $real_yield }} @endisset<span> &nbsp;&nbsp;&nbsp;％</span></td>
          <td style="width: 60px;"></td>
          <td class="long-text" style="border-bottom: 1px solid #DEE2E6">税引き後CF累計(売却含む)</td>
          <td class="value value-special minus-check" style="border-bottom: 1px solid #DEE2E6">&nbsp;@isset($include_sale_cumulative_CF_after_tax) {{ $include_sale_cumulative_CF_after_tax }} @endisset &nbsp;<span>万円</span></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">税引き前CF</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($before_tax_CF) {{ $before_tax_CF }} @endisset &nbsp;<span>万円</span></td>
          <td style="width: 82px;"></td>
          <td> </td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">税率(所得税、住民税)</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($tax) {{ $tax }} @endisset<span> &nbsp;&nbsp;&nbsp;％</span></td>
          <td style="width: 82px;"></td>
          <td> </td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">税引き後CF</td>
          <td class="value minus-check" style="border-bottom: 1px solid #DEE2E6">@isset($after_tax_CF) {{ $after_tax_CF }} @endisset &nbsp;<span>万円</span></td>
          <td style="width: 82px;"></td>
          <td> </td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
    
    <div class="item-title">オプション項目<br /></div>
    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">物件名</td>
          <td class="value" style="border-bottom: 1px solid #DEE2E6">@isset($property_name) {{ $property_name }} @endisset &nbsp;&nbsp;</td>
          <td style="width: 60px;"></td>
          <td></td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="item-box">
      <thead>
        <tr>
          <td style="border-bottom: 1px solid #DEE2E6">築年数</td>
          <td class="value" style="border-bottom: 1px solid #DEE2E6">@isset($age) {{ $age }} @endisset<span> &nbsp;&nbsp;&nbsp;年</span></td>
          <td style="width: 60px;"></td>
          <td></td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <div>メモ</div>
    <table class="note-box">
      <thead>
        <tr>
          <th>
          @isset($note) {{ $note }} @endisset
          </th>
        </tr>
      </thead>
    </table>
    
  </main>
</body>
</html>
