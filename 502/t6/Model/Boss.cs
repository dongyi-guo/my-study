using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Tutorial_8___Razi.Model
{
    class Boss
    {
        private List<Employee> EmployeeList;

        public Boss()
        {
            EmployeeList = Agency.Generate();
        }

        public List<Employee> Display()
        {
            return EmployeeList.OrderBy(e => e.Id).ToList();
        }

        public Employee Recruit(string name, Enums.Genders gender)
        {
            try
            {
                int maxId = EmployeeList.OrderByDescending(e => e.Id).First().Id;
                Employee employee = new Employee(++maxId, name, gender);
                EmployeeList.Add(employee);
                return employee;
            }
            catch(Exception)
            { }

            return null;
        }

        public Employee Use(int id)
        {
            Employee employee = EmployeeList.FirstOrDefault(e => e.Id == id);

            if(employee != null && employee.Id > 0)
            {
                return employee;
            }

            return null;
        }

        public Employee Fire(int id)
        {
            Employee employee = EmployeeList.FirstOrDefault(e => e.Id == id);

            if (employee != null && employee.Id > 0)
            {
                EmployeeList.Remove(employee);
                return employee;
            }

            return null;
        }
    }
}
