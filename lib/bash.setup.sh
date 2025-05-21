#
my_home=$(dirname "$0")               # get the folder I'm in.
my_home=$(cd "$my_home";pwd)          # convert that to an absolute path
export my_root=$(dirname "$my_home")  # get the parent folder of my folder
                                      #====================================
                                      # get the project user id, username
sysname=$(uname -s)
if [[ "$sysname" == "Linux" || "$sysname" == "MINGW"* ]]; then # Check for Linux or MINGW
    export my_uid=$(stat -c '%u' "$my_root")
elif [[ "$sysname" == "FreeBSD" ]]; then # Check for FreeBSD
    export my_uid=$(stat -f '%u' "$my_root")
else # Fallback for other systems
    carp "Warning: Unknown system type ($sysname). Attempting stat -f for UID."
    export my_uid=$(stat -f '%u' "$my_root")
fi

export my_user=$(id -un "$my_uid" | tr -d '\n')
#                                       #====================================
export my_bin="${my_root}/bin"		# get bin folder.
export my_lib="${my_root}/lib"		# get lib folder.
export my_etc="${my_root}/etc"		# get etc folder.
export my_var="${my_root}/var"		# get var folder.
export my_tmp="${my_root}/tmp"		# get tmp folder.
export my_log="${my_root}/log"		# get log files.
export my_public="${my_root}/public"    # get public folder.
export my_node=$(hostname|/usr/bin/tr '[:upper:]' '[:lower:]')
export my_node_data="${my_var}/node/${my_node}"
if [[ ! -d "$my_node_data" ]]
then
	mkdir -p "$my_node_data"
fi

export PATH="${my_root}/bin:${PATH}"
#
# setup standard ENV values for command line PHP/Composer
#
export COMPOSER_HOME="${my_var}/.composer"
export COMPOSER="${my_etc}/composer.json"
export COMPOSER_VENDOR_DIR="${my_lib}/vendor"
export COMPOSER_BIN_DIR="${my_bin}"
