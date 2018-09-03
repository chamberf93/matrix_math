<?php

// Class for Matrix Math
class Matrix{

  public $rows;
  public $cols;
  public $data;
  private $max;
  private $min;
  private const REGEX_NUMBER = "/^(\-)|(\d)*$/";


  // Constuctor - set rows and col
  function __construct($rows, $cols){

    // Check if rows or cols are 0
    if(($rows <= 0) ||( $cols <= 0)){
      echo "Error: Cols or Rows are below or equal to zero";
      return false;
    }

    // Check if the rows is a numnber
    if(!$this->check_number($rows)){
      echo "Error: Row is not a number";
      return false;
    }

    // Check if the cols is a number
    if(!$this->check_number($cols)){
      echo "Error: Cols is not a number";
      return false;
    }

    // Set Cols and Rows
    $this->rows = $rows;
    $this->cols = $cols;

    // Default
    $this->set_random(0,10);

    // Set a Zero Matrix
    for ($i=0; $i < $rows; $i++) {
      for ($j=0; $j < $cols; $j++) {
        $this->data[$i][$j] = 0;
      }
    }
  }

  // Setting Random Values for Current Matrix
  public function set_random($a, $b){

     // Check if a is a number
    if (!$this->check_number($a)) {
      echo "Error: Min is not a number";
      return false;
    }

    // Check if b is a number
    if (!$this->check_number($b)) {
      echo "Error: Max is not a number";
      return false;
    }

    // Set Max and Min
    $this->max = $a;
    $this->min = $b;
  }

  // Check if Matrix
  public function check_matrix($a){

    if($a instanceof Matrix)
      return true;

    return false;
  }

  // Set Unique Values to a Matrix
  function set_value($value, $row, $col){

    // Check if Value is a number
    if(!$this->check_number($value)){
      echo "Error: Value is not a number";
      return false;
    }

    // Check if Row is a number
    if(!$this->check_number($row)){
      echo "Error: Row is not a number";
      return false;
    }

    // Check if Col is a number
    if(!$this->check_number($col)){
      echo "Error: Col is not a number";
      return false;
    }

    // Check if row is out of bounds
    if($row > $this->rows || $row <= 0){
      echo "Error: Out of Bounds on Rows";
      return false;
    }

    // Check if col is out of bounds
    if($col > $this->cols || $col <= 0){
      echo "Error: Out of Bounds on Cols";
      return false;
    }

    // Set Data
    $this->data[$row-1][$col-1] = $value;
  }

  // Print Out a table representing a matrix
  public function print(){

    echo "<table>";

    for ($i=0; $i < $this->rows; $i++) {
      echo "<tr>";
      for ($j=0; $j < $this->cols; $j++) {
        echo "<td>".$this->data[$i][$j]."</td>";
      }
      echo "</tr>";
    }

    echo "</table>";
  }

  // Randomize the Data in the matrix
  public function random(){

    for ($i=0; $i < $this->rows; $i++) {
      for ($j=0; $j < $this->cols; $j++) {
        $this->data[$i][$j] = rand($this->min,$this->max);
      }
    }

  }

  // Add a Matrix to another Matrix
  // Add a single digit to all matrix values
  public function add($n){

    // Check for instance matrix
    if($this->check_matrix($n)){

      if($this->rows != $n->rows || $this->cols != $n->cols){
        echo "Error: Rows and Cols not not match up";
        return false;
      }

      // Matrix Add
      for ($i=0; $i < $this->rows; $i++) {
        for ($j=0; $j < $this->cols; $j++) {
          $this->data[$i][$j] +=$n->data[$i][$j];
        }
      }
    }else{

      // Checl for Numbers
      if(!$this->check_number($n)){
        echo "Error: Number being added is not a number";
        return false;
      }

      // Single Number add to all values
      for ($i=0; $i < $this->rows; $i++) {
        for ($j=0; $j < $this->cols; $j++) {
          $this->data[$i][$j] +=$n;
        }
      }
    }
  }


  // Multiply
  public function multiply($n){

    // Check for instance matrix
    if($this->check_matrix($n)){
      if($this->rows != $n->rows || $this->cols != $n->cols){
        echo "Error: Rows and Cols not not match up";
        return false;
      }

      // Matrix Multiply
      for ($i=0; $i < $this->rows; $i++) {
        for ($j=0; $j < $this->cols; $j++) {
          $this->data[$i][$j] *= $n->data[$i][$j];
        }
      }
    }else{

      // Check if n is a number
      if(!($this->check_number($n))){
        echo "Error: Number being multiplied is not a number";
      }

      // scaler multiply
      for ($i=0; $i < $this->rows; $i++) {
        for ($j=0; $j < $this->cols; $j++) {
          $this->data[$i][$j] *=$n;
        }
      }
    }
  }

  // Map function
  // Maps a user definined function to all elements of the matrix
  public function map($fn){

    if(!is_callable($fn)){
      echo "Error function is not callable";
      return false;
    }

    for ($i=0; $i < $this->rows; $i++) {
      $this->data[$i] = array_map($fn,($this->data[$i]));
    }
  }

  //////////////////////////////////////////////////
  // Static functions - returns a matrix

  // Matrix Add
  public static function matrix_add($a, $b){

    // Check if a is an instance of a Matrix
    if(!($a instanceof Matrix)){
      echo "Error: First Paramater is not a Matrix";
      return false;
    }

    // Check if b is an instance of a Matrix
    if(!($b instanceof Matrix)){
      echo "Error: Second Paramater is not a Matrix";
      return false;
    }

    // Check if rows and cols are equal
    if($a->rows == $b->rows && $a->cols == $b->cols ){
      $result = new Matrix($a->rows, $b->cols);
      for ($i=0; $i < $result->rows; $i++) {
        for ($j=0; $j < $result->cols; $j++) {
          $result->data[$i][$j] = $a->data[$i][$j] + $b->data[$i][$j];
        }
      }
      return $result;
    }
  }

  // Matrix Subtract
  public static function matrix_subtract($a, $b){

    // Check if a is an instance of a Matrix
    if(!($a instanceof Matrix)){
      echo "Error: First Paramater is not a Matrix";
      return false;
    }

    // Check if b is an instance of a Matrix
    if(!($b instanceof Matrix)){
      echo "Error: Second Paramater is not a Matrix";
      return false;
    }

    // Check if Cols and Rows are equal
    if($a->rows == $b->rows && $a->cols == $b->cols ){

      $result = new Matrix($a->rows, $b->cols);

      for ($i=0; $i < $result->rows; $i++) {
        for ($j=0; $j < $result->cols; $j++) {
          $result->data[$i][$j] = $a->data[$i][$j] - $b->data[$i][$j];
        }
      }
      return $result;
    }
  }

  // Matrix Dot Product
  public static function matrix_dot_product($a, $b){

    // Check if a is an instance of a Matrix
    if(!($a instanceof Matrix)){
      echo "Error: First Paramater is not a Matrix";
      return false;
    }

    // Check if b is an instance of a Matrix
    if(!($b instanceof Matrix)){
      echo "Error: Second Paramater is not a Matrix";
      return false;
    }

    // Check Condition for Dot Product
    if($a->cols !== $b->rows){
      echo "Error: Matrix 1 Cols != Matrix 2 Rows";
      return "Error";
    }

    $result = new Matrix($a->rows, $b->cols);

    for ($i=0; $i < $result->rows; $i++) {
      for ($j=0; $j < $result->cols; $j++) {
        $sum = 0;
        for ($k=0; $k < $a->cols; $k++) {
          $sum += $a->data[$i][$k] * $b->data[$k][$j];
        }
        $result->data[$i][$j] = $sum;
      }
    }
    return $result;
  }

  // Matrix Transpose
  public static function matrix_transpose($a){

    // Check if a is an instance of a Matrix
    if(!($a instanceof Matrix)){
      echo "Error: First Paramater is not a Matrix";
      return false;
    }

    $result = new Matrix($a->cols, $a->rows);
    for ($i=0; $i < $a->rows ; $i++) {
      for ($j=0; $j < $a->cols; $j++) {
        $result->data[$j][$i] = $a->data[$i][$j];
      }
    }
    return $result;
  }

  // Matrix map
  public static function matrix_map($matrix, $fn){

    // Check if matrix is an instance of Matrix
    if(!($matrix instanceof Matrix)){
      echo "Error: First Paramater is not a Matrix";
      return false;
    }

    $result = new Matrix($matrix->rows, $matrix->cols);

    for ($i=0; $i < $matrix->rows; $i++) {
      $result->data[$i] = array_map($fn,($matrix->data[$i]));
    }
    return $result;
  }

  //////////////////////////////////////////////////
  // Private functions

  // Check if Number
  private function check_number($a){

    // Check for Number with Regex
    if(preg_match(SELF::REGEX_NUMBER, $a))
      return true;

    return false;
  }
}
?>
