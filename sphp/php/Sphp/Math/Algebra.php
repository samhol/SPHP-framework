<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Math;

/**
 * Description of Algebra
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Algebra {

  /**
   * Binary GCD algorithm
   * 
   * @param int $u
   * @param int $v
   * @return int
   */
  public static function gcd(int $u, int $v): int {
    //echo "u:  $u, v: $v \n";
    // simple cases (termination)
    if ($u === $v) {
      return $u;
    }
    if ($u === 0) {
      return $v;
    }
    if ($v === 0) {
      return $u;
    }
    // look for factors of 2
    if (~$u & 1) { // u is even
      if ($v & 1) { // v is odd
        return static::gcd($u >> 1, $v);
      } else { // both u and v are even
        return static::gcd($u >> 1, $v >> 1) << 1;
      }
    }
    if (~$v & 1) { // u is odd, v is even
      return static::gcd($u, $v >> 1);
    }
    // reduce larger argument
    if ($u > $v) {
      return static::gcd(($u - $v) >> 1, $v);
    }
    return static::gcd(($v - $u) >> 1, $u);
  }

  /**
   * Laskee pienimmän yhteisen jaettavan rekursiivisesti.
   *
   * @param  int $u kokonaisluku
   * @param  int $v kokonaisluku
   * @return int pienin yhteinen jaettava
   */
  public static function lcm(int $u, int $v): int {
    return $v * ($u / self::gcd($u, $v));
  }

  /**
   * Factorizes an integer
   *
   * @param  int $n kokonaisluku
   * @return int tekijä
   */
  public static function factorize(int $n): int {
    $a = $b = 2;
    while (true) {
      $a = (pow($a, 2) + 1) % $n;
      $b = (pow(pow($b, 2) + 1, 2) + 1) % $n;
      $d = gcd($a - $b, $n);
      if ($d > 1 && $d < $n) {
        return $d;
      }
      if ($d == 1) {
        throw new RuntimeException("Factors for " . $n . " can not be found");
      }
    }
  }

  /**
   * Calculates $a^-1 (mod n).
   *
   * @param  int $a
   * @param  int $n
   * @return int $a^-1 (mod n)
   * @throws Exception jos $a^-1 (mod n) ei ole olemassa
   */
  public static function invMod($a, $n) {
    $invertible = $a;
    while ($a < 0) {
      $a += $n;
    }
    $modulo = $n;
    $alpha = $delta = 1;
    $beta = $gamma = 0;
    //print_r(array("a" => $a, "n" => $n, "alpha" => $alpha, "beta" => $beta, "gamma" => $gamma, "delta" => $delta));
    while ($a > 0) {
      $q = floor($n / $a);
      $r = $n - $q * $a;
      $gamma = $gamma - $q * $alpha;
      $alpha ^= $gamma ^= $alpha ^= $gamma; //swap($alpha,$gamma)
      $delta = $delta - $q * $beta;
      $beta ^= $delta ^= $beta ^= $delta; //swap($beta,$delta)
      $n = $r;
      $a ^= $n ^= $a ^= $n; //swap($a,$n)
      //print_r(array("q" => $q,"r" => $r, "a" => $a, "n" => $n, "alpha" => $alpha, "beta" => $beta, "gamma" => $gamma, "delta" => $delta));
    }
    if ($n != 1) {
      throw new Exception($invertible . " has no inverse in mod(" . $modulo . ")");
    }
    if ($gamma < 0) {
      return $gamma + $modulo;
    } else {
      return $gamma;
    }
  }

  /**
   * Laskee a^c mod(n).
   *
   * @precondition   $a >= 0 & $c >= 0 & $n >= 0
   * @param  int $a kantaluku
   * @param  int $c exponentti
   * @param  int $n modulo
   * @return int a^c mod(n)
   */
  public static function modPow(int $a, int $c, int $n): int {
    $x = 1;
    $s = $a % $n;
    $cBin = base_convert($c, 10, 2);
    //echo "\nc=".$cBin."\n";
    $k = strlen($cBin) - 1;
    if ($cBin[$k] == 1) {
      $x = $a;
    }
    for ($i = $k - 1; $i >= 0; $i--) {
      $s = pow($s, 2) % $n;
      if ($cBin[$i] == 1) {
        $x = ($x * $s) % $n;
      }
      //print_r(array("i" => $i, "x" => $x, "s" => $s));
    }
    return $x;
  }

  /**
   * Laskee $x*$R^-1 (mod $n).
   *
   *  - <b>Alkuehto:</b>   $R > $n & $n*$n_ == -1 mod($R) & 0 <= $x <= $n*$R
   *  - <b>Loppuehto:</b>  RESULT == $x*$R^-1 (mod $n)
   * @param  int $n modulo
   * @param  int $n_ ($n*$n_ = -1 mod($R))
   * @param  int $R chosen
   * @param  int $x
   * @return int $x*$R^-1 (mod $n)
   */
  public static function montgomeryReduction(int $n, int $n_, int $R, int $x) {
    $u = ($x * $n_) % $R;
    $v = ($x + $u * $n) / $R;
    if ($v > $n) {
      $v = $v - $n;
    }
    //echo "montgomeryReduction(n=$n, n'=$n_, R=$R, x=$x)=".$v;
    echo $v;
    return $v;
  }

  /**
   * Laskee $x*$R^-1 (mod $n).
   *
   *  - <b>Alkuehto:</b>   $R > $n & $n*$n_ == -1 mod($R) & 0 <= $x <= $n*$R
   *  - <b>Loppuehto:</b>  RESULT == $x*$R^-1 (mod $n)
   * @param  int $n modulo
   * @param  int $a kantaluku
   * @param  int $c exponentti
   * @param  int $n_ ($n*$n_ = -1 mod($R))
   * @param  int $R chosen
   * @return int a^c mod(n)
   */
  public static function montgomeryExponentation($n, $a, $c, $n_, $R) {
    //echo "montgomeryExponentation(n=$n, a=$a, c=$c, n'=$n_, R=$R):";
    $R2 = ($R * $R) % $n;
    //echo "\n R^2=".$R2;
    //echo "\n x=";
    $x = Algebra::montgomeryReduction($n, $n_, $R, 1 * $R2);
    //echo "\n s=";
    $s = Algebra::montgomeryReduction($n, $n_, $R, $a * $R2);
    $cBin = base_convert($c, 10, 2);
    echo "\n c=bin(" . $cBin . ")";
    $k = strlen($cBin) - 1;
    if ($cBin[$k] == 1) {
      $x = $s;
      //echo "\n x=s=$s, koska c[0] = 1\n";
    }
    //echo "\n Silmukka alkaa:";
    $t = 1;
    for ($i = $k - 1; $i >= 0; $i--) {
      //echo "\n\tKIERROS $t:";
      //echo "\n\t s=mr(s^2)=";
      $s = Algebra::montgomeryReduction($n, $n_, $R, pow($s, 2));
      if ($cBin[$i] == 1) {
        //echo "\n\t\t x=mr(x*s)=";
        $x = Algebra::montgomeryReduction($n, $n_, $R, $x * $s);
        //echo ", koska c[".$t."]=1";
      }
      $t++;
    }
    //echo "\n Silmukka loppuu: \n x=mr(x)=";
    $x = Algebra::montgomeryReduction($n, $n_, $R, $x);
    //echo "\n";
    return $x;
  }

  /**
   * Laskee diskreetin logaritmin log<sub>$alpha</sub>$beta (mod $n)
   *
   * @param int $alpha
   * @param int $beta
   * @param int $n
   * @return int log<sub>$alpha</sub>$beta (mod $n)
   * @throws IllegalArgumentException
   */
  public static function discreteLogarithm($alpha, $beta, $n) {
    $x = $x2 = 1;
    $a = $b = $a2 = $b2 = 0;
    for ($i = 1; $i < $n; $i++) {
      self::new_xab_DLP($alpha, $beta, $n, $x, $a, $b);
      self::new_xab_DLP($alpha, $beta, $n, $x2, $a2, $b2);
      self::new_xab_DLP($alpha, $beta, $n, $x2, $a2, $b2);
      echo "\n" . $i . ":\t" . $x . "\t" . $a . "\t" . $b . "\t" . $x2 . "\t" . $a2 . "\t" . $b2 . "\t";
      if ($x == $x2) {
        $r = $b - $b2;
        if ($r == 0) {
          throw new IllegalArgumentException();
        }
        return (self::invMod($r, $n) * ($a2 - $a)) % $n;
      }
    }
    throw new IllegalArgumentException();
  }

  /**
   * Laskee seuraavat DLP-algiritmin tarvitsemat arvot arvot
   *
   * @param type $alpha logaritmin kantaluku
   * @param type $beta luku, jolle logaritmi lasketaan
   * @param int $n modulo (alkuluku)
   * @param int $x
   * @param int $a
   * @param int $b
   */
  private static function new_xab_DLP($alpha, $beta, $n, &$x, &$a, &$b) {
    if (($x % 3) == 1) {
      $x = ($beta * $x) % $n;
      $a = $a % ($n - 1);
      $b = ($b + 1) % ($n - 1);
    } else if (($x % 3) == 0) {
      $x = ($x * $x) % $n;
      $a = (2 * $a) % ($n - 1);
      $b = (2 * $b) % ($n - 1);
    } else {
      $x = ($alpha * $x) % $n;
      $a = ($a + 1) % ($n - 1);
      $b = $b % ($n - 1);
    }
  }

}
