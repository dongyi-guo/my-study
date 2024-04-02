using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Tutorial_8___Razi.Model
{
    abstract class Agency
    {
        public static List<Employee> Generate()
        {
            return new List<Employee>() {
                new Employee (1, "Jane", Enums.Genders.F), 
                new Employee (3, "John", Enums.Genders.M), 
                new Employee (7, "Mary", Enums.Genders.F), 
                new Employee (5, "Lindsay", Enums.Genders.X), 
                new Employee (2, "Meilin", Enums.Genders.F)
            };
        }
    }
}
