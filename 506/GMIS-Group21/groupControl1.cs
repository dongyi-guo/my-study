using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Navigation;

namespace GMIS
{
    public class Database
    {
        private static bool reportingErrors = false;

        private const string db = "gmis";
        private const string user = "gmis";
        private const string pass = "gmis";
        private const string server = "alacritas.cis.utas.edu.au";
        protected static MySqlConnection mySqlConnection = null;

    }


    public static List<group> LoadAll()
    {
        List<group> m = new List<group>();

        MySqlConnection conn = GetConnection();
        MySqlDataReader rdr = null;

        try
        {
            conn.Open();

            MySqlCommand cmd = new MySqlCommand("select * from group", conn);
            rdr = cmd.ExecuteReader();

            while (rdr.Read())
            {
                //Note that in your assignment you will need to inspect the *type* of the
                //employee/researcher before deciding which kind of concrete class to create.
                m.view (GroupItem { group_name = rdr.GetInt32(0), group_id = rdr.GetString(1) + " " + rdr.GetString(2) });
            }
        }
        catch (MySqlException e)
        {
            ReportError("loading staff", e);
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

        return staff;
    }

}