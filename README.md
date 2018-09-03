# matrix_math
Math Operations On Matrices

Public Function List:
  These function all modify the current matrix object.
1) construct($rows, $cols) - Creates Matrix.
2) set_random($min, $max) - sets minimum and maximum values for random number generator.
3) set_value($value, $x, $y) - sets single value for location in matrix.
4) print() - print out matrix into table.
5) random() - sets random numbers into matrix.
6) add($n) - adds a single number to all matrix indices, or if matrix is passed in, adds two matrices to gether
7) multiply($n) - multipies a single number to all matrix indices, or if matrix is padded in, multiplies index-wise.
8) map(func) - maps a user defined function to all values in the matrix.
9) check_matrix($matrix) - checks if matrix.

Public Static Funcion List:
  These function create a new matrix object and returns it.
1) Matrix::matrix_add($matrix1, $matrix2) - returns the sum of the matrices.
2) Matrix::matrix_subtract($matrix1, $matrix2) -  retruns the difference between $matrix1 and $matrix2.
3) Matrix::matrix_dot_product($matrix1, $matrix2) - return the dot product of 2 matrices.
4) Matrix::matrix_transpose($matrix) - returns the transpose of the matrix.
5) Matrix::matrix_map($matrix, $func) - returns a mapped matrix that has been remapped by the function.

Private Function List:
  These are private functions - used to check data,
1) check_number($n) - checks with regex if input is a number. 
