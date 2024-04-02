# Modern File Systems

## Assignment Research Essay

* In Week 7, initial resources of you gathering for the research needed to be submitted.
* Need Highlighting, Annotation and Comment on your resources.
* Can add-on after Week 7, differentiation is appreciated.
* Make them archive.
* Everything you used should be submitted in the end.

## File System Role

* We need a structured way of storing the information.
    * Name, Length (Bytes), Pointers
    * Metadata
    * Map of block allocation
* Hierarchical - files and directories.
* Ownership and access permissions for multi-user systems.

## File System Evolution

### Early FS:

* Always takes the entire disk.

Examples:

* FAT(DOS) - File Allocation Table
    * Originally an 8-bit system.
    * FAT-8, then succeeded by FAT-12, FAT-16 ,FAT-32, EX-FAT, and finally NTFS
* MFS(Macintosh) - Macintosh File System
    * Succeeded by HFS and HFS+, then APFS
* FS(Unix)
    * Succeeded by BSD FFS, UFS and UFS2.

Limitation:

* All designed when drives are like megabytes level.
    * No gigabyte, terabyte or petabyte support.
* Optimized for spinning media characteristics.

### Partition

* Whole-disk FS presented challenges as disk sizes increased.
    * Some FS just couldn't cope with the increased number of sectors/blocks on large disks.
    * Solution could be user larger chunk - 4KB instead of 1KB - but of course, results in wasted space if many very small files need to be stored.
* Enable single drive could appear as multiple virtual disks, and each of them contains different FS.
    * Partition Map required.
    * Start, length, FS type for each partition.
    * Allows specific purpose (boot, data, swap...)
    * Fixed size after creation.
        * Resizing is either impossible or requires careful movement of any data before updating the partition table.

Partitioning Standards

* MBR - Master Boot Record
    * Most Common.
    * Introduced in 1983, still supported on many OS.
    * Limited number of partitions.
        * Unless use "extended" mode.
* APM - Apple Partition Map
    * Developed for Apple's 68K and PowerPC systems.
    * Deprecated, superseded by GUID on Apple's Intel systems.
* GUID - Global Unique Identifier
    * Part of UEFI standard.
    * Developed during the early 2000s.
    * Includes protective MBR so GUID-unaware systems don't overwrite GUID drive data.

## Modern FS

LVM: Logical Volume Manager

* From 1998, active, now LVM2.
* Mainly on Linux.
* Not a FS:
    * Maps one or more physical storage volumes into a single logical volume that is presented to the filesystem layer.
    * Allows physical devices that are part of the logical volume to be added and/or replaced (hot-swapped).
    * Support volume resizing.
    * Supports snapshots and encryption.
    * Supports logical volumes with RAID-like redundancy features.

Ext4 - Extended File System 4

* Default filesystem for many Linux distros, such as Debian and Ubuntu, and maybe Android.
* Introduced in 2008 as evolution of ext2 and ext3.
* Scalability
    * Up to 1 Exbibyte.
    * File sizes up to 16 Tebibytes (TiB) with a 4KiB block size.
* Advanced features
    * Journaling, journal and metadata checksums, quotas and encryption.

Btrfs - "b-tree" File System

* Developed by Oracle in 2007.
    * COW principles
    * Default on SUSE (12+) and Fedora (33+)
* Scalability
    * Max volume or file size 16 Exbibytes (EiB)
* Advanced features
    * COW, snapshots, sub-volumes, storage pools, de-duplication.

ExFAT - Extensible File Allocation Table

* Successor to FAT / FAT 16 / FAT 32.
* Released by Microsoft in 2006, published as a specification in 2019, licensable.
* Widely used on SD card.
* Scalability
    * Max volume size 128 Pebibytes (PiB)
    * Max file size 16 Exbibytes (EiB)
* Unicode filenames.

NTFS - New Technology File System

* Developed by Microsoft to replace FAT in 1993.
* For Windows NT, still in use today.
* Subsequent updates to support additional features.
* Scalability
    * Max volume size 2^64-1 cluster, for a 4K cluster, the largest volume can be 16 TiB.
    * Max file size on Windows 10 in 8 PiB (NTFS has a much larger theoretical limit of 16 EiB).
* Advanced features
    * Journaling, transactions, forks (alt. data streams), on-the-fly file compression OR encryption., sparse storage, quotas.

APFS - Apple File System

* Released in 2017, replaces HFS+.
* Default FS for all modern Apple devices and OS.
* Scalability: 
    * Max volume size 2^63 blocks, for 4K block, the largest volume can be 8 Tebibytes (TiB).
    * Max file size 2^63 bytes (9 quintillion) - 8 Exbibytes (EiB).
* Advanced features
    * COW, snapshots, forks, journaling, containers (volumes inside other volumes), fusion drives (a single volume which spans multiple devices), sparse storage, compression, encryption.
* Limitations
    * No support for data integrity (checksums).
    * Very slow on spinning drives, and not generally recommended for them.
    * Friendly only with non-moving storage, like SSDs.

ZFS - Zed FS

* Originally developed by Sun in early 2000s, now owned by Oracle.
    * Combines the filesystem and volume manager into a single entity.
    * Open-source.
* Scalability
    * Max size of zpool is 256 quadrillion Zebibytes (2^128 bytes)
    * Max file size is 2^63 bytes (9 quintillion) = 16 Exbibytes
* Advanced feature
    * COW, snapshots, journaling, compression, de-duplication, encryption, RAID features, extensive data integrity checks, quotas, hot spares.
    * Taking backup into consideration.
* Limitations
    * High resource requirements and use (especially data de-duplication).

## Desirable FS Features / Current Limitations

* Longer name.
* Larger scale of storages.
* Forks.
    * Alternative Data Streams for NTFS.
    * Extended attributes - ZFS
* Journaling, transactions, built-in data integrity checking and redundancy.
    * Intending to make a change.
* Timestamps.
* Snapshots.
* Drive pooling.
* Encryption-at-rest.
* Quotas, sparse storage, compression, file versioning and space sharing.
* Copy-on-Write (COW)
    * Duplicate when copied.
        * Involves checksums or hashes.
        * ZFS
    * Pointer instead of actually moving it.
    * Save time.

## Terminology

* Disk: Physical Device where data can be stored. 
* Partition: Subset of a physical device, on which data can be stored.
    * Each partition can have their own FS.
* Volume: Raw space of FS can be created.
    * Volume can consist one partition, or multiple partitions distributed across multiple physical devices.
* FS - logical, structured way of using a space on a volume for data storage, including filenames and metadata such as ownership.

RAID: Redundant Array of Inexpensive Disks

* A way to create one or more logical storage volumes from multiple physical disks.
* Provides redundancy in case of disk failure.
* Improves performance.
* Level:
    * RAID 0: stripes data across multiple drives, improves performance with no redundancy.
    * RAID 1: exact mirror of data on 2 or more drives, gives redundancy but no performance.
    * RAID 4: dedicated parity drive for checking/recovering data.
    * RAID 5: block-level striping, distributed parity, one drive can fail and data is still accessible.
    * RAID 6: block-level striping, distributed double-parity, two drives can fail and data is still accessible.
* Some RAID levels can be combined: RAID 1+0 for both redundancy and performance.

Forks: (Alternate Data Streams on Windows NTFS)

* One or more separate sets of data associated with a regular file.
* Firstly use in early Macintosh systems to separate the data from the resources associated with it.
* Many application ignore forks.
* Known vector for malware on some systems.
* Similar to Extended attributes on some filesystems.
    * Forks can be the same size of the file tho.

Journaling:

* Keep track of changes that have not yet committed to the FS.
* Done by recording the intention to make a change into a journal file before the change made.
    * Once change committed safely journal entry will be removed.
* Reduces the chance that the FS will be come corrupted due to interruption like break-out or hardware failure.

Snapshots:

Copy-On-Write (COW)

* If no-COW, a duplicate is made when a file is copied.
* If COW, a new directory entry is created that points to the original data blocks.
    * When either copy updates, the original data is copied and changes are applied.
* Happens on both the file and data block level.
* Provides
    * Faster duplication in one FS.
    * Simplified snapshots
    * Better FS integrity for failures in terms of copying.

De-duplication

* Actively looks for duplicates
    * Collapse multiple duplicates into one file with blockers.
* File or block level.
* Requires easy way to detect duplication without exhaustive search.
    * Or will be slow
    * Checksums or hashes
* ZFS

Drive Pooling

* Modern FS allow multiple physical drives or partitions to be aggregated into a single larger pool.
    * This is not redundancy, it's about capacity.
    * Physical entities could be individual drives or partitions, or even RAID arrays with their own redundancy.

Sparse Storage

* A storage technique that only allocates space to data blocks that contain actual values.
    * Save space - empty blocks are not allocated.
    * Save time - no operation on empty blocks.
