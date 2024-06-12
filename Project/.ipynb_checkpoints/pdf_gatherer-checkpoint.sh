#!/usr/bin/env bash

# Author: Dongyi Guo
#
# This script runs with Bash, it will assume user has a Endnote library
# "702.enlp" on the Desktop, it will gather all the PDF files in this
# library, and move them into a "PDF" directory in the same file hierarchy.


mkdir -p PDF
list_files="$(find ~/Desktop/702.enlp/*.Data/PDF -name "*.pdf" -type f)"
fcounter=0

while IFS= read -r fn_line
do
    cp "$fn_line" PDF/
    echo "File ${fn_line} was copied into PDF directory."
    fcounter=$((fcounter+1))
done <<< "$list_files"

echo "${fcounter} files processed."
