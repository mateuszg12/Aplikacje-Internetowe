#include <iostream>
#include <unistd.h>
#include <fstream>
#include <string> 

int main()
{	
	while(true)
	{
		std::string name = "/sys/devices/virtual/thermal/thermal_zone0/temp";
		std::string tmp;
		std::fstream plik;
		std::fstream plik_out;
		plik_out.open("/home/odroid/Desktop/PRW-core-app/data.txt", std::ios::out | std::ios::trunc);

		for (int i = 0; i < 4; i++)
		{
			name[41] = '0' + i;
			plik.open(name, std::ios::in);
			plik >> tmp;
			plik.close();
			std::cout << tmp[0] << tmp[1] << std::endl;
			plik_out << tmp[0];
			plik_out << tmp[1];
			plik_out << ":";	
		}

		std::string tmp_out = "";
		std::string wiad_out = "";	
		int licznik = 0;
		int suma_pracy = 0;
		int suma_idle = 0;
		int wsp = 0;

		name = "/proc/stat";
		plik.open(name, std::ios::in);
		getline(plik, tmp);
	
		for(int i = 0; i < 4; i++)
		{
			getline(plik, tmp);
			licznik = 0;
		
			for(int j = 5; j < tmp.size(); j++)
			{
				if(tmp[j] != ' ')
				{
					tmp_out += tmp[j];
				}
				else
				{
					if(licznik != 3)
					{
						suma_pracy += std::stoi(tmp_out);
					}
					else
					{
						suma_idle += std::stoi(tmp_out);
					}
				
					tmp_out = "";
					licznik++;
				}
			}
			wsp = suma_pracy/(suma_pracy + suma_idle);
			wiad_out += std::to_string(wsp) + ":";
		}

		plik_out << wiad_out;
		plik_out.close();
		system("curl -T /home/odroid/Desktop/PRW-core-app/data.txt ftp://ftpupload.net/htdocs/data/data.txt --user USER:PASSWORD");
		sleep(10);
	}
	return 0;
}
