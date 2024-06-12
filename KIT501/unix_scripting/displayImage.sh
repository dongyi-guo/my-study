#!/bin/bash

# ********************************
# KIT501 Unix Scripting Assignment
# ********************************

# ***************************************************
# Name: Dongyi Guo
# Student ID: 662970
# Last Modified Date: 11/05/2023
# Indentation: 2 spaces
# Soft Wrap Enabled (80 characters per line exceeded)
# ***************************************************

# ****************************************************************************************************************
# Purpose of ./displayImage.sh:
# ./displayImage.sh is a binary image viewer, it takes a converted image file using 8-bit binary numbers to
# represent its pixels and display it within the terminal, it provides 2 modes of display, whether showing the
# image throughout the iteration or outputting everything at once. ./displayImage.sh will also handle 12 different
# kinds of errors upon misuse it (3 parameter errors) or image file corruption (6 binary value errors and 3 meta
# validation errors) and it will present them to the user with appropriate feedback.
# ****************************************************************************************************************

# ******************************
# Provided Variable Declarations
# ******************************
# Allows a string to include the newline character
NL=$'\n'
# Allows a string to include the newline character and 4-space indentation for the next line
NL4S=$'\n    '
# An 80-character string that provides ASCII character matching to different shade levels
ASCII_SHADE='$@B%8&WM#*oahkbdpqwmZO0QLCJUYXzcvunxrjft/\|()1{}[]?-_+~<>i!lI;:,"^`\'"'"'.          '
# Preserved System IFS
PIFS=$IFS

# ***************
# Parameter Check
# ***************
# Check if there are 2 parameters
[ $# -ne 2 ] && echo "Usage: ./displayImage.sh image-file delay-output${NL4S}image-file: a file containing 1 or lines of comma-separated binary-value data${NL4S}delay-output: 0 - show output immediately${NL4S}delay-output: 1 - delay display until all lines processed" >> /dev/stderr && exit 127
# Check if file exists
[ ! -f "$1" ] && echo "File ${1} not found!" >> /dev/stderr && exit 127
# Check if there is reading permission on test file for current user
[ ! -r "$1" ] && echo "File ${1} is not readable!" >> /dev/stderr && exit 127
# Check if output mode set right
[ "$2" != "0" ] && [ "$2" != "1" ] && echo "delay-output value was not 0 or 1" >> /dev/stderr && exit 127

# *********************
# Pre-defined Variables
# *********************
imageFile=$1 # The path to the image file
delayedOutput=$2 # The desired output mode
hasError=1 # The boolean to tell whether there are errors detected
delayedPrompt="The binary to ASCII delayed output is as follows:" # Prompt for delayed output
detectedRows=0 # The actual detected rows
binaryErrors="" # The placeholder for binary value error logs
validationErrors="" # The placeholder for validation error logs
imageOutput="" # The placeholder for image output


# ***************
# Meta Processing
# ***************
informationLine=$(head -n 1 "$imageFile") # Retrieve the meta line
numOfChars=$(echo "$informationLine" | cut -f 1 -d : ) # Get the reported character number with 'C' in the end
requiredLength=$((${#numOfChars} - 1)) # Calculate the required length for substringing
numOfChars=${numOfChars:0:$requiredLength} # Get rid of the 'C'
numOfCols=$(echo "$informationLine" | cut -f 2 -d : ) # Get the reported column number with 'W' in the end
requiredLength=$((${#numOfCols} - 1)) # Calculate the required length for substringing
numOfCols=${numOfCols:0:$requiredLength} # Get rid of the 'W'
numOfRows=$(echo "$informationLine" | cut -f 3 -d : ) # Get the reported row number with 'H' in the end
requiredLength=$((${#numOfRows} - 1))  # Calculate the required length for substringing
numOfRows=${numOfRows:0:$requiredLength} # Get rid of the 'H'
title=$(echo "$informationLine" | cut -f 4 -d : ) # Get the title
# File Information Header
header="-----------------------------------------------${NL}File information:${NL}-----------------------------------------------${NL}Number chars reported:    ${numOfChars}${NL}Number of col reported:   ${numOfCols}${NL}Number of lines reported: ${numOfRows}${NL}Title:                    ${title}${NL}-----------------------------------------------"
# Error Legend
legend="-----------------------------------------------${NL}Errors were discovered:${NL}-----------------------------------------------${NL}LEGEND for individual binary value errors:${NL4S}ERROR1 - starts with a letter${NL4S}ERROR2 - ends with a letter${NL4S}ERROR3 - starts with a number (not 0 or 1)${NL4S}ERROR4 - ends with a number (not 0 or 1)${NL4S}ERROR5 - only binary digits, but less than 8${NL4S}ERROR6 - anything else...${NL}-----------------------------------------------"

# ******************************
# Validation of Binary Values
# ******************************

# Check Error 1: binary value starts with a letter
function checkError1 {
  local para=$1
  local headOfChar=${para:0:1}
  case "$headOfChar" in
    [a-zA-Z]) return 0 ;;
    *) return 1 ;;
  esac
}

# Check Error 2: binary value ends with a letter
function checkError2 {
  local para=$1
  local tailIndex
  tailIndex=$((${#para} - 1))
  local tailOfChar=${para:$tailIndex:1}
  case "$tailOfChar" in
    [a-zA-Z]) return 0 ;;
    *) return 1 ;;
  esac
}

# Check Error 3: binary value starts with a non-0-1 number
function checkError3 {
  local para=$1
  local headOfChar=${para:0:1}
  case "$headOfChar" in
    [2-9]) return 0 ;;
    *) return 1 ;;
  esac
}

# Check Error 4: binary value ends with a non-0-1 number
function checkError4 {
  local para=$1
  local tailIndex
  tailIndex=$((${#para} - 1))
  local tailOfChar=${para:$tailIndex:1}
  case "$tailOfChar" in
    [2-9]) return 0 ;;
    *) return 1 ;;
  esac
}

# Check Error 5: binary value doesn't have length of 8
function checkError5 {
  local para=$1
  [ -z "${para//[01]}" ] && [ ${#para} -lt 8 ] && return 0
  return 1
}

# Check Error 6: Other errors
function checkError6 {
  local para=$1
  [ ! -z "${para//[01]}" ] && return 0
  [ ${#para} -gt 8 ] && return 0
  return 1
}

# Check whether binary number has any of the 6 binary value errors
# If so, return the first type of the errors found
function validate {
  checkError1 "$1" && hasError=0 && echo 1 && return
  checkError2 "$1" && hasError=0 && echo 2 && return
  checkError3 "$1" && hasError=0 && echo 3 && return
  checkError4 "$1" && hasError=0 && echo 4 && return
  checkError5 "$1" && hasError=0 && echo 5 && return
  checkError6 "$1" && hasError=0 && echo 6 && return
}

# Transfer a 8-bit binary value into decimal
function getIndex {
  local binary=$1
  local value=0
  [ "${binary:0:1}" == "1" ] && value=$((value + 128))
  [ "${binary:1:1}" == "1" ] && value=$((value + 64))
  [ "${binary:2:1}" == "1" ] && value=$((value + 32))
  [ "${binary:3:1}" == "1" ] && value=$((value + 16))
  [ "${binary:4:1}" == "1" ] && value=$((value + 8))
  [ "${binary:5:1}" == "1" ] && value=$((value + 4))
  [ "${binary:6:1}" == "1" ] && value=$((value + 2))
  [ "${binary:7:1}" == "1" ] && value=$((value + 1))
  [ "$value" -gt 79 ] && echo 79 && return
  echo "$value"
}

# ******************************
# Iteration
# ******************************
function iterate {
  IFS=$NL # Set IFS to newline character
  isMeta=0 # Check whether the line is meta line
  while read -r row # Iterate the file by taking rows
  do
    # If this line is the first line (Meta line), set relevant boolean to false and skip this loop
    [ $isMeta -eq 0 ] && isMeta=1 && continue
    badRow=1 # Boolean of whether this row is corrupted with errors
    colsInRow=0 # The counter of columns for this row
    detectedRows=$((detectedRows + 1)) # Counter of rows for this file +1
    rowValue="" # The placeholder for this row's image value
    IFS="," # Set IFS to comma
    for char in $row # Iterate the characters in this row
    do
      badChar=1 # Boolean of whether this character is corrupted with a binary value error.
      colsInRow=$((colsInRow + 1)) # Counter of columns for this row +1
      detectedChars=$((detectedChars + 1)) # Counter of rows for this file +1
      # Examine whether this character is corrupted by a binary value error
      # If so, prepare the error message for further output and set the boolean flagging there is an error.
      case $(validate "$char") in
      1) badChar=0 && binaryErrors="${binaryErrors}ERROR1 - line ${detectedRows}  column ${colsInRow}: ${char}${NL}" ;;
      2) badChar=0 && binaryErrors="${binaryErrors}ERROR2 - line ${detectedRows}  column ${colsInRow}: ${char}${NL}" ;;
      3) badChar=0 && binaryErrors="${binaryErrors}ERROR3 - line ${detectedRows}  column ${colsInRow}: ${char}${NL}" ;;
      4) badChar=0 && binaryErrors="${binaryErrors}ERROR4 - line ${detectedRows}  column ${colsInRow}: ${char}${NL}" ;;
      5) badChar=0 && binaryErrors="${binaryErrors}ERROR5 - line ${detectedRows}  column ${colsInRow}: ${char}${NL}" ;;
      6) badChar=0 && binaryErrors="${binaryErrors}ERROR6 - line ${detectedRows}  column ${colsInRow}: ${char}${NL}" ;;
      esac
      # If there is an error for this character, attach 'E' as the output value.
      [ $badChar -eq 0 ] && badRow=0 && hasError=0 && rowValue="${rowValue}E"
      # If there is no error, calculate the decimal value of the binary, index it with the 80-level of ASCII
      # grayscale and attach the desired output value.
      [ $badChar -ne 0 ] && index=$(getIndex "$char") && charValue=${ASCII_SHADE:index:1} && rowValue="${rowValue}${charValue}"
    done
    # Check for this row, whether there is the correct amount of columns presented as reported,
    [ "$colsInRow" -ne "$numOfCols" ] && badRow=0 && validationErrors="${validationErrors}Row ${detectedRows} has an invalid column count (${colsInRow} should be ${numOfCols})${NL}" && hasError=0

    # If the displayMode is 0, then print out the row upon finishing iterating on it.
    ## If there is an error in this row, attach '(error found)' in the end.
    [ "$delayedOutput" == "0" ] && [ $badRow -eq 0 ] && echo "${rowValue}    (error found)"
    ## If no error then just output the row's content.
    [ "$delayedOutput" == "0" ] && [ $badRow -ne 0 ] && echo "$rowValue"

    # If the displayMode is 1, then save the row output into the placeholder for future output.
    ## If there is an error in this row, attach '(error found)' in the end.
    [ "$delayedOutput" == "1" ] && [ $badRow -eq 0 ] && imageOutput="${imageOutput}${rowValue}    (error found)${NL}"
    ## If no error then just output the row's content.
    [ "$delayedOutput" == "1" ] && [ $badRow -ne 0 ] && imageOutput="$imageOutput$rowValue$NL"
  done < "$imageFile"
  IFS=$PIFS # Restore the IFS
  # Check whether the actual counted number of rows match the reported number of rows in meta.
  # If no, then prepare the error output for future.
  [ "$detectedRows" -ne "$numOfRows" ] && validationErrors="${validationErrors}File ${imageFile} has an invalid line count (${detectedRows} should be $numOfRows)${NL}" && hasError=0
  # Check whether the actual counted number of characters match the reported number of characters in meta.
  # If no, then prepare the error output for future.
  [ "$detectedChars" -ne "$numOfChars" ] && validationErrors="${validationErrors}File ${imageFile} has an invalid character count (${detectedChars} should be $numOfChars)${NL}" && hasError=0
}

# ******************************
# Main
# ******************************
echo "$header" # Print out the File Information Header
# If the displayMode is 1, give the waiting prompt as well
[ "$delayedOutput" == "1" ] && echo "$delayedPrompt"
iterate # Do the actual iteration
# If the displayMode is 1, make the delayed output.
[ "$delayedOutput" == "1" ] && echo "$imageOutput"
# If there are errors, print out the error legend and display the prepared error messages.
[ $hasError -eq 0 ] && echo "${legend}${NL}${binaryErrors}${validationErrors}-----------------------------------------------"
