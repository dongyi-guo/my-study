using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GMIS
{
    class ClassControler
    {
        private List<Class> m;
        public List<Class> Classes{ get { return m; } set { } }

        private ObservableCollection<Class> viewablem;
        public ObservableCollection<Class> VisibleClasses { get { return viewablem; } set { } }

        public ObservableCollection<Class> GetViewableList()
        {
            return VisibleClasses;
        }



    }
}
