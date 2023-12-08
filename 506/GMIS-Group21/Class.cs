using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GMIS
{
    public enum Day { Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday };

    public class Class
    {
        public int class_id { get; set; }

        public int group_id { get; set; }

        public Day day { get; set; }

        public TimeSpan start { get; set; }

        public TimeSpan end { get; set; }

        public char room { get; set; }


        public override string ToString()
        {
            return class_id + "\t" + group_id + "\t" + day + "\t" + start + "\t" + end + "\t" + room;
        }
    }



}
