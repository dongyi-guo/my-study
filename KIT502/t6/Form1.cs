using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

using Tutorial_8___Razi.Model;

namespace Tutorial_8___Razi
{
    public partial class Form1 : Form
    {
        Boss boss;

        public Form1()
        {
            InitializeComponent();

            boss = new Boss();
            this.PopulateEmployeeGrid();
        }

        private void BtnAddEmployee_Click(object sender, EventArgs e)
        {
            if(this.textBox1.Text.Trim() == "")
            {
                ShowMessage("Please enter name");
                return;
            }

            var employee = boss.Recruit(this.textBox1.Text.Trim(), (Enums.Genders)Enum.Parse(typeof(Enums.Genders), comboBox1.SelectedItem.ToString()));
            this.ShowMessage(employee.ToString() + " has been added.");
            this.PopulateEmployeeGrid();
            this.textBox1.Clear();
        }

        private void BtnRemoveEmployee_Click(object sender, EventArgs e)
        {
            foreach(DataGridViewRow row in dataGridView1.Rows)
            {
                if(Convert.ToBoolean(row.Cells[0].Value))
                {
                    var employee = boss.Fire(int.Parse(row.Cells[1].Value.ToString()));
                    this.ShowMessage(employee.ToString() + " has been removed.");
                    this.PopulateEmployeeGrid();
                }
            }
        }

        private void PopulateEmployeeGrid()
        {
            this.dataGridView1.DataSource = boss.Display();
        }

        private void ShowMessage(string message)
        {
            MessageBox.Show(message, "Information", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }
    }
}
