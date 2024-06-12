using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GMIS
{
    class MeetingControler
    {
        private List<Meeting> m;
        public List<Meeting> Meetings { get { return m; } set { } }

        private ObservableCollection<Meeting> viewablem;
        public ObservableCollection<Meeting> VisibleMeetings { get { return viewablem; } set { } }

        public ObservableCollection<Meeting> GetViewableList()
        {
            return VisibleMeetings;
        }



    }
}
