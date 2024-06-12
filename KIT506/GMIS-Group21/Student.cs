using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GMIS
{
    public enum campus { Hobart, Launceston};
    public enum category { Bachelors, Masters};
    public class Student
    {
         public int student_id { get; set; }

        public string given_name { get; set; }

        public string family_name { get; set; }

        public int group_id{ get; set; }

        public char title { get; set; }

        public campus campus { get; set; }

         public string phone { get; set; }

        public string email { get; set; }

        public byte photo  { get; set; }

        public category category { get; set; }

          public override string ToString()
        {
            return student_id + "\t" + given_name + "\t" + family_name + "\t" + group_id + "\t" + title + "\t" + campus + "\t" + phone + "\t" + email + "\t" + photo + "\t" + category;
        }
    }
}
