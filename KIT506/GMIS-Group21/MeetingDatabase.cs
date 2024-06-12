using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GMIS
{
    abstract class Database
    {
        private static bool reportingErrors = false;

        private const string db = "gmis";
        private const string user = "gmis";
        private const string pass = "gmis";
        private const string server = "alacritas.cis.utas.edu.au";
        protected static MySqlConnection mySqlConnection = null;

    }


    public static List<Meeting> LoadAll()
    {
        List<Meeting> m = new List<Meeting>();

        MySqlConnection conn = GetConnection();
        MySqlDataReader rdr = null;

        try
        {
            conn.Open();

            MySqlCommand cmd = new MySqlCommand("select * from Meeting", conn);
            rdr = cmd.ExecuteReader();

            while (rdr.Read())
            {

                m.Add(new Meeting
                {
                    meeting_id = rdr.GetInt32(0),
                    group_id = rdr.GetInt32(1),
                    day = rdr.GetString(2),
                    start = rdr.GetDateTime(3),
                    end = rdr.GetDateTime(4),
                    room = rdr.GetString(5)
                });

                MySqlCommand cmd = new MySqlCommand("select * from Meeting where Meeting.group_id = Student.group_id", conn);
                rdr = cmd.ExecuteReader();

                while (rdr.Read())
                {

                    m.Add(new Meeting
                    {
                        meeting_id = rdr.GetInt32(0),
                        group_id = rdr.GetInt32(1),
                        day = rdr.GetString(2),
                        start = rdr.GetDateTime(3),
                        end = rdr.GetDateTime(4),
                        room = rdr.GetString(5)
                    });
                }
            }
        }


        finally
        {
            if (rdr != null)
            {
                rdr.Close();
            }
            if (conn != null)
            {
                conn.Close();
            }
        }

        return m;
    }
}
