window.addEventListener('DOMContentLoaded', () => {
  // 各数字入力input要素取得
  const propertyPrice = document.getElementById('property_price');
  const purchaseFee = document.getElementById('purchase_fee');
  const borrowingAmount = document.getElementById('borrowing_amount');
  const annualInterest = document.getElementById('annual_interest');
  const borrowingPeriod = document.getElementById('borrowing_period');
  const monthlyRentIncome = document.getElementById('monthly_rent_income');
  const expense = document.getElementById('expense');
  const vacancy = document.getElementById('vacancy');
  const tax = document.getElementById('tax');
  const ownershipPeriod = document.getElementById('ownership_period');
  const salePrice = document.getElementById('sale_price');
  const saleCommission = document.getElementById('sale_commission');
  const age = document.getElementById('age');

  /**
   * 任意の桁で切り捨てする関数
   * @param {number} value 切り捨てする数値
   * @param {number} base どの桁で切り捨てするか（10→10の位、0.1→小数第１位）
   * @return {number} 切り捨てした値
   */
   function setFloor(value, base) {
    return Math.floor(value * base) / base;
  }

  // --- 物件価格の入力(keyup)制約 ---
  propertyPrice.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (propertyPrice.value < 1) {
      let num = propertyPrice.value;
      propertyPrice.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(propertyPrice.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return propertyPrice.value = "";
    }
    propertyPrice.value = parseFloat(num);
  });

  // --- 物件価格の入力(change)制約 ---
  propertyPrice.addEventListener('change', () => {
    // 入力された内容を取得
    let num = propertyPrice.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return propertyPrice.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    propertyPrice.value = num;
  });

  // --- 購入手数料の入力(keyup)制約 ---
  purchaseFee.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (purchaseFee.value < 1) {
      let num = purchaseFee.value;
      purchaseFee.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(purchaseFee.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return purchaseFee.value = "";
    }
    purchaseFee.value = parseFloat(num);
  });

  // --- 購入手数料の入力(change)制約 ---
  purchaseFee.addEventListener('change', () => {
    // 入力された内容を取得
    let num = purchaseFee.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return purchaseFee.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    purchaseFee.value = num;
  });

  // --- 借入金額の入力(keyup)制約 ---
  borrowingAmount.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (borrowingAmount.value < 1) {
      let num = borrowingAmount.value;
      borrowingAmount.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(borrowingAmount.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return borrowingAmount.value = "";
    }
    borrowingAmount.value = parseFloat(num);
  });

  // --- 借入金額の入力(change)制限 ---
  borrowingAmount.addEventListener('change', () => {
    // 入力された内容を取得
    let num = borrowingAmount.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return borrowingAmount.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    borrowingAmount.value = num;
  });

  // --- 年間利息の入力(keyup)制約 ---
  annualInterest.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (annualInterest.value < 1) {
      let num = annualInterest.value;
      annualInterest.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(annualInterest.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return annualInterest.value = "";
    }
    annualInterest.value = parseFloat(num);
  });

  // --- 年間利息の入力(change)制限 ---
  annualInterest.addEventListener('change', () => {
    // 入力された内容を取得
    let num = annualInterest.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return annualInterest.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    annualInterest.value = num;
  });

  // --- 借入期間の入力(keyup)制約 ---
  borrowingPeriod.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (borrowingPeriod.value < 1) {
      let num = borrowingPeriod.value;
      borrowingPeriod.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(borrowingPeriod.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return borrowingPeriod.value = "";
    }
    borrowingPeriod.value = parseFloat(num);
  });

  // --- 借入期間の入力(change)制限 ---
  borrowingPeriod.addEventListener('change', () => {
    // 入力された内容を取得
    let num = borrowingPeriod.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return borrowingPeriod.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    borrowingPeriod.value = num;
  });

  // --- 月家賃収入の入力(keyup)制約 ---
  monthlyRentIncome.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (monthlyRentIncome.value < 1) {
      let num = monthlyRentIncome.value;
      monthlyRentIncome.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(monthlyRentIncome.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return monthlyRentIncome.value = "";
    }
    monthlyRentIncome.value = parseFloat(num);
  });

  // --- 月家賃収入の入力(change)制限 ---
  monthlyRentIncome.addEventListener('change', () => {
    // 入力された内容を取得
    let num = monthlyRentIncome.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return monthlyRentIncome.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    monthlyRentIncome.value = num;
  });

  // --- 経費率の入力(keyup)制約 ---
  expense.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (expense.value < 1) {
      let num = expense.value;
      expense.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(expense.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return expense.value = "";
    }
    expense.value = parseFloat(num);
  });

  // --- 経費率の入力(change)制限 ---
  expense.addEventListener('change', () => {
    // 入力された内容を取得
    let num = expense.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return expense.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    expense.value = num;
  });

  // --- 空室率の入力(keyup)制約 ---
  vacancy.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (vacancy.value < 1) {
      let num = vacancy.value;
      vacancy.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(vacancy.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return vacancy.value = "";
    }
    vacancy.value = parseFloat(num);
  });

  // --- 空室率の入力(change)制限 ---
  vacancy.addEventListener('change', () => {
    // 入力された内容を取得
    let num = vacancy.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return vacancy.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    vacancy.value = num;
  });

  // --- 税率の入力(keyup)制約 ---
  tax.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (tax.value < 1) {
      let num = tax.value;
      tax.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(tax.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return tax.value = "";
    }
    tax.value = parseFloat(num);
  });

  // --- 税率の入力(change)制限 ---
  tax.addEventListener('change', () => {
    // 入力された内容を取得
    let num = tax.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return tax.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    tax.value = num;
  });

  // --- 所有期間の入力(keyup)制約 ---
  ownershipPeriod.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (ownershipPeriod.value < 1) {
      let num = ownershipPeriod.value;
      ownershipPeriod.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(ownershipPeriod.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return ownershipPeriod.value = "";
    }
    ownershipPeriod.value = parseFloat(num);
  });

  // --- 所有期間の入力(change)制限 ---
  ownershipPeriod.addEventListener('change', () => {
    // 入力された内容を取得
    let num = ownershipPeriod.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return ownershipPeriod.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    ownershipPeriod.value = num;
  });

  // --- 売却価格の入力(keyup)制約 ---
  salePrice.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (salePrice.value < 1) {
      let num = salePrice.value;
      salePrice.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(salePrice.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return salePrice.value = "";
    }
    salePrice.value = parseFloat(num);
  });

  // --- 売却価格の入力(change)制限 ---
  salePrice.addEventListener('change', () => {
    // 入力された内容を取得
    let num = salePrice.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return salePrice.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    salePrice.value = num;
  });

  // --- 売却手数料率の入力(keyup)制約 ---
  saleCommission.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (saleCommission.value < 1) {
      let num = saleCommission.value;
      saleCommission.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(saleCommission.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return saleCommission.value = "";
    }
    saleCommission.value = parseFloat(num);
  });

  // --- 売却手数料率の入力(change)制限 ---
  saleCommission.addEventListener('change', () => {
    // 入力された内容を取得
    let num = saleCommission.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return saleCommission.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    saleCommission.value = num;
  });

  // --- 築年数の入力(keyup)制約 ---
  age.addEventListener('keyup', () => {
    // 1以下の数値の入力をする
    if (age.value < 1) {
      let num = age.value;
      age.value = num;
      return;
    }

    // 入力された内容を取得
    let num = Math.floor(age.value * 10) / 10;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return age.value = "";
    }
    age.value = parseFloat(num);
  });

  // --- 築年数の入力(change)制限 ---
  age.addEventListener('change', () => {
    // 入力された内容を取得
    let num = age.value;
    // input要素が空であれば何も表示しない
    if (num == "") {
      return age.value = "";
    }
    // 小数点第一位以降は切り捨て
    setFloor(num, 10);
    // 入力内容に小数点がなければ小数点を入れる
    if (num.indexOf(".") < 0) {
      num += ".";
    }
    // 小数点で整数部と小数部を分ける
    let str = num.split(".");
    // 小数点第一位もしくは小数点第二位に0を追加
    str[1] = str[1] + "0";
    // 整数部に数字がない場合は、整数部に0を追加
    if (str[0] == false) {
      str[0] == 0;
    }
    // 整数部と小数部を合わせる(小数部は小数点第一位まで表示)
    num = str[0] + "." + str[1].substr(0, 1);
    // 入力されたinput要素に反映
    age.value = num;
  });

});
