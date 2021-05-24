<?php

namespace App\Library;

class Calculate {
 
  public function return_calculate($calculate) {

    if ($calculate['monthly_rent_income'] != 0 || $calculate['monthly_rent_income'] != null) {

      if ($calculate['purchase_fee'] != 0.0 || $calculate['purchase_fee'] != null) {
        // 表面利回り計算
        $totalPurchase = round($calculate['property_price'] + ($calculate['property_price'] * ($calculate['purchase_fee'] * 0.01)), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        
        // 実質利回り計算
        if ($calculate['expense'] == 0 || $calculate['expense'] == null || $calculate['vacancy'] == 0 || $calculate['vacancy'] == null) {
          $annualTakeHome = 0.0;
          $real_yield = 0.0; // 実質利回り
        } else {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り
          $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0.0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0.0 || $calculate['annual_interest'] != null) {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
              
            } else {

              $annualRepaymentAmount = round((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12))))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
            }


          } else {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

    
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            }

          }

        } else {
  
          $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF

          return $resultCalc = ([
            'property_price' => sprintf("%.1f\n", $calculate['property_price']),
            'surface_yield' => sprintf("%.1f\n", $surface_yield),
            'real_yield' => sprintf("%.1f\n", $real_yield),
            'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
          ]);
        }

      } else {

        // 表面利回り計算
        $totalPurchase = round(($calculate['property_price']), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        // 実質利回り計算
        if ($calculate['expense'] == 0 || $calculate['expense'] == null || $calculate['vacancy'] == 0 || $calculate['vacancy'] == null) {
          $surface_yield = 0.0; 
          $annualTakeHome = 0.0; //年間手取り
          $real_yield = 0.0; // 実質利回り
        } else {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り
          $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0 || $calculate['annual_interest'] != null) {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
              
            } else {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額
      
              $surface_yield = 0.0;
              $real_yield = 0.0;
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
            }


          } else {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額
              $surface_yield = 0.0;
              $real_yield = 0.0;
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            }

          }

        } else {
  
          $surface_yield = 0.0;
          $real_yield = 0.0;
          $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF

          return $resultCalc = ([
            'property_price' => sprintf("%.1f\n", $calculate['property_price']),
            'surface_yield' => sprintf("%.1f\n", $surface_yield),
            'real_yield' => sprintf("%.1f\n", $real_yield),
            'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
          ]);
        }

        return $resultCalc = ([
          'property_price' => sprintf("%.1f\n", $calculate['property_price']),
          'surface_yield' => sprintf("%.1f\n", 0.0),
          'real_yield' => sprintf("%.1f\n", 0.0),
          'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
        ]);
      }

    } else {

      if ($calculate['purchase_fee'] != 0.0 || $calculate['purchase_fee'] != null) {
        // 表面利回り計算
        $totalPurchase = round($calculate['property_price'] + ($calculate['property_price'] * ($calculate['purchase_fee'] * 0.01)), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        // 実質利回り計算
        if ($calculate['expense'] == 0 || $calculate['expense'] == null || $calculate['vacancy'] == 0 || $calculate['vacancy'] == null) {
          $annualTakeHome = 0.0;
          $real_yield = 0.0; // 実質利回り
        } else {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り
          $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0 || $calculate['annual_interest'] != null) {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
              
            } else {

              $annualRepaymentAmount = round((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12))))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
            }


          } else {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0) ** ($calculate['borrowing_period'] * 12)) / ((1 + 0) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            }

          }

        } else {
  
          $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF

          return $resultCalc = ([
            'property_price' => sprintf("%.1f\n", $calculate['property_price']),
            'surface_yield' => sprintf("%.1f\n", $surface_yield),
            'real_yield' => sprintf("%.1f\n", $real_yield),
            'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
          ]);
        }

      } else {

        // 表面利回り計算
        $totalPurchase = round(($calculate['property_price']), 1); // 購入総額
        $annualRentIncome = 0.0; // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        $annualTakeHome = 0.0; /// 年間手取り
        $real_yield = 0.0; // 実質利回り

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0 || $calculate['annual_interest'] != null) {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
              
            } else {

              $annualRepaymentAmount = round((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12))))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
            }


          } else {

            if ($calculate['borrowing_period'] != 0) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0) ** ($calculate['borrowing_period'] * 12)) / ((1 + 0) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            }

          }

        } else {
  
          $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF

          return $resultCalc = ([
            'property_price' => sprintf("%.1f\n", $calculate['property_price']),
            'surface_yield' => sprintf("%.1f\n", $surface_yield),
            'real_yield' => sprintf("%.1f\n", $real_yield),
            'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
          ]);
        }

        return $resultCalc = ([
          'property_price' => sprintf("%.1f\n", $calculate['property_price']),
          'surface_yield' => sprintf("%.1f\n", 0.0),
          'real_yield' => sprintf("%.1f\n", 0.0),
          'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
        ]);
      }
    }

  }
}