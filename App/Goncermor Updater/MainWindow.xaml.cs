using System.IO;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace Goncermor_Updater
{
    public partial class MainWindow : Window
    {
        private Storyboard? FadeIn;
        private Storyboard? FadeOut;
        private Storyboard? CircleIn;
        private Storyboard? CircleOut;

       

        public MainWindow()
        {
            InitializeComponent();
            FadeIn = this.FindResource("FadeIn") as Storyboard;
            FadeOut = this.FindResource("FadeOut") as Storyboard;
            CircleIn = this.FindResource("CircleIn") as Storyboard;
            CircleOut = this.FindResource("CircleOut") as Storyboard;
           
        }

        private async void Window_ContentRendered(object sender, EventArgs e)
        {
            FadeIn?.Begin();
            await Task.Delay(1000);
            CircleIn?.Begin();
            await Task.Delay(2000);

            AppInfo? AppInfo;
            if (File.Exists("App.conf")) AppInfo = new AppInfo();
            else
            {
                
            }

            

        // Check For Downloads
        Storyboard? Stb = this.FindResource("Loading") as Storyboard;
            Stb?.Begin();
            for (float i = 0;i!=100;i++)
            {
                Status.Content = $"Downloading Update {i}%";
                await Task.Delay(50);
            }
            Stb?.Stop();


            await Task.Delay(2000);

            CircleOut?.Begin();
            await Task.Delay(2000);
            FadeOut?.Begin();
            await Task.Delay(1000);
            Environment.Exit(0);
           

        }
    }
}