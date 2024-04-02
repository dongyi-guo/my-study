using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;
using System.Windows.Forms;
using System.IO;
using Microsoft.VisualBasic;


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
    
    public static List<Student> LoadAll()
    {
        List<Student> m = new List<Student>();

        MySqlConnection conn = GetConnection();
        MySqlDataReader rdr = null;

        try
        {
            conn.Open();

            MySqlCommand cmd = new MySqlCommand("select * from Student", conn);
            rdr = cmd.ExecuteReader();

              while (rdr.Read())
                {
                  
                    m.Add(new Student {
                        student_id = rdr.GetInt32(0), 
                        given_name = rdr.GetString(1),
                        family_name = rdr.GetString(2), 
                        group_id = rdr.GetInt32(3),
                        title = rdr.GetString(4),
                        campus=(campus) rdr.GetChar(5),
                        phone=rdr.GetString(6),
                        email=rdr.GetString(7),
                        photo=rdr.GetByte(8),
                        category= (category) rdr.GetChar(9)
                    });
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



       
    
    public static List<Class> LoadAll()
    {
        List<Class> m = new List<Class>();

        MySqlConnection conn = GetConnection();
        MySqlDataReader rdr = null;

        try
        {
            conn.Open();

            MySqlCommand cmd = new MySqlCommand("select * from Class", conn);
            rdr = cmd.ExecuteReader();


          while (rdr.Read())
                {
                  
                    m.Add(new Class {
                        class_id = rdr.GetInt32(0), 
                        group_id = rdr.GetInt32(1),
                        day = rdr.GetString(2), 
                        start = rdr.GetDateTime(3),
                        end = rdr.GetDateTime(4),
                        room = rdr.GetString(5)
                    });
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



         