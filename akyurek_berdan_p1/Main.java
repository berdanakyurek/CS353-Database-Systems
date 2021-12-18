import java.sql.*;

public class Main 
{
    public static void main(String[] args) 
    {

        try
        {
            // Connection
            Connection db = DriverManager.getConnection("jdbc:mysql://dijkstra.cs.bilkent.edu.tr:3306/berdan_akyurek", "berdan.akyurek", "pqsah83r");
            
            Statement st = db.createStatement();
            
            
            // Table Creation
            st.executeUpdate("DROP TABLE IF EXISTS apply;");
            st.executeUpdate("DROP TABLE IF EXISTS student;");
            st.executeUpdate("DROP TABLE IF EXISTS company;");
            
            st.executeUpdate("CREATE TABLE student(sid CHAR(12), sname VARCHAR(50), bdate DATE, address VARCHAR(50), scity VARCHAR(20), year CHAR(20), gpa FLOAT, nationality VARCHAR(20), PRIMARY KEY(sid)) ENGINE = INNODB;");
            st.executeUpdate("CREATE TABLE company(cid CHAR(8), cname VARCHAR(20), quota INT, PRIMARY KEY(cid)) ENGINE = INNODB;");
            st.executeUpdate("CREATE TABLE apply(sid CHAR(12), cid CHAR(8), PRIMARY KEY(sid, cid), FOREIGN KEY(sid) REFERENCES student(sid), FOREIGN KEY(cid) REFERENCES company(cid)) ENGINE = INNODB;");

            // Table Population
            st.executeUpdate("INSERT INTO student(sid, sname, bdate, address, scity, year, gpa, nationality) VALUES(21000001, 'John', STR_TO_DATE('14-05-1999', '%d-%m-%Y'), 'Windy', 'Chicago', 'senior', 2.33, 'US');");
            st.executeUpdate("INSERT INTO student(sid, sname, bdate, address, scity, year, gpa, nationality) VALUES(21000002, 'Ali', STR_TO_DATE('30-09-2001', '%d-%m-%Y'), 'Nisantasi', 'Istanbul', 'junior', 3.26, 'TC');");
            st.executeUpdate("INSERT INTO student(sid, sname, bdate, address, scity, year, gpa, nationality) VALUES(21000003, 'Veli', STR_TO_DATE('25-02-2003', '%d-%m-%Y'), 'Nisantasi', 'Istanbul', 'freshman', 2.41, 'TC');");
            st.executeUpdate("INSERT INTO student(sid, sname, bdate, address, scity, year, gpa, nationality) VALUES(21000004, 'Ayse', STR_TO_DATE('15-01-2003', '%d-%m-%Y'), 'Tunali', 'Ankara', 'freshman', 2.55, 'TC');");

            st.executeUpdate("INSERT INTO company(cid, cname, quota) VALUES('C101', 'microsoft', 2);");
            st.executeUpdate("INSERT INTO company(cid, cname, quota) VALUES('C102', 'merkez bankasi', 5);");
            st.executeUpdate("INSERT INTO company(cid, cname, quota) VALUES('C103', 'tai', 3);");
            st.executeUpdate("INSERT INTO company(cid, cname, quota) VALUES('C104', 'tubitak', 5);");
            st.executeUpdate("INSERT INTO company(cid, cname, quota) VALUES('C105', 'aselsan', 3);");
            st.executeUpdate("INSERT INTO company(cid, cname, quota) VALUES('C106', 'havelsan', 4);");
            st.executeUpdate("INSERT INTO company(cid, cname, quota) VALUES('C107', 'milsoft', 2);");

            st.executeUpdate("INSERT INTO apply(sid, cid) VALUES(21000001, 'C101');");
            st.executeUpdate("INSERT INTO apply(sid, cid) VALUES(21000001, 'C102');");
            st.executeUpdate("INSERT INTO apply(sid, cid) VALUES(21000001, 'C103');");
            st.executeUpdate("INSERT INTO apply(sid, cid) VALUES(21000002, 'C101');");
            st.executeUpdate("INSERT INTO apply(sid, cid) VALUES(21000002, 'C105');");
            st.executeUpdate("INSERT INTO apply(sid, cid) VALUES(21000003, 'C104');");
            st.executeUpdate("INSERT INTO apply(sid, cid) VALUES(21000003, 'C105');");
            st.executeUpdate("INSERT INTO apply(sid, cid) VALUES(21000004, 'C107');");

            // SELECT * FROM student
            printResult(st.executeQuery("SELECT * FROM student;"));
            
        }
        catch(Exception exc)
        {
            System.out.println(exc);
            System.exit(-1);
        }
        
    }

    public static void printResult(ResultSet set)
    {
        try
        {
            ResultSetMetaData md = set.getMetaData();
            for (int i = 1; i <= md.getColumnCount(); i++) 
            {
                String sn = md.getColumnName(i);
                System.out.print(sn);
                for(int j = 0; j < 12 - sn.length(); j ++)
                            System.out.print(" ");
            }
            System.out.println();
            for(int i = 0; i < 96; i ++)
                System.out.print("-");
            System.out.println();

            while(set.next())
            {
                for (int i = 1; i <= md.getColumnCount(); i++) 
                {
                    if (i != 1) 
                        for(int j = 0; j < 12 - set.getString(i-1).length(); j ++)
                            System.out.print(" ");

                    System.out.print(set.getString(i) );
                }
                System.out.println();
            }
            
        }
        catch(Exception exc)
        {
            System.out.println(exc);
            System.exit(-2);
        }

        
    }
}
