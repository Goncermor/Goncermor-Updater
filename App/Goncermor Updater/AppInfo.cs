using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Text.Json;
using System.Text.Json.Serialization;
using System.Threading.Tasks;

namespace Goncermor_Updater
{
     internal class AppInfo
     {
        public static string? AppId { get; set; }
        public static string? Channel { get; set; }
        public static string? Version { get; set; }
        
        public AppInfo()
        {
            string FileData = File.ReadAllText("App.conf");
            Types.VersionInfo? VersionInfo = JsonSerializer.Deserialize<Types.VersionInfo>(FileData);
            AppId = VersionInfo?.AppId;
            Channel = VersionInfo?.Channel;
            Version = VersionInfo?.Version;
        }
    }
    
}
