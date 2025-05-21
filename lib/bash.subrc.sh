#
source `dirname $0`/../lib/bash.setup.sh
my_name=`basename $0 | sed -E 's/^(.*)\.sh$/\1/'`			# get my name.
my_home=`dirname $0`			# get the folder I'm in.
my_date=`date +%Y-%m-%d`		# get a date/hour timestamp
my_day=`date +"%a" | tr "[:upper:]" "[:lower:]"` # get the 3 char day of week.
my_logf=${my_log}/${my_name}-${my_date}.log
#   make sure system tools are used first
export PATH="${my_root}/bin:${PATH}"
say() {
	echo "`date +%Y-%m-%d:%H:%M:%S` ($$): $*"
}
carp() {
	echo >&2 "`date +%Y-%m-%d:%H:%M:%S` ($$)\* $*"
}
if [ ! -t 1 ]
then
	exec >>${my_logf}            # send out output to that file.
fi
