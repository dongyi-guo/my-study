using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Tutorial_8___Razi.Model
{
    class Employee
    {
        private int _id;
        private string _name;
        private Enums.Genders _gender;

        public Employee()
        {
            this.Id = 0;
            this.Name = "";
            this.Gender = Enums.Genders.M;
        }

        public Employee(int id, string name, Enums.Genders gender)
        {
            this.Id = id;
            this.Name = name;
            this.Gender = gender;
        }

        public int Id
        {
            get { return this._id + 100; }
            set { this._id = value; }            
        }

        public string Name
        {
            get { return this._name; }
            set { this._name = value; }
        }

        public Enums.Genders Gender
        {
            get { return this._gender; }
            set { this._gender = value; }
        }

        public override string ToString()
        {
            return this.Name + " (" + this.Id + "); Gender: " + (Enums.Genders)this.Gender;
        }
    }
}
