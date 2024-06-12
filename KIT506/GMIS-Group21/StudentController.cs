using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GMIS
{
    class StudentControler
    {
        private List<Student> m;
        public List<Student> Students { get { return m; } set { } }

        private ObservableCollection<Student> viewablem;
        public ObservableCollection<Student> VisibleStudents { get { return viewablem; } set { } }

        public ObservableCollection<Student> GetViewableList()
        {
            return VisibleStudents;
        }



    }
}

