package pages;

import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.ui.Select;

import static org.openqa.selenium.support.PageFactory.initElements;

public class CategoriesPage {

    private WebDriver webDriver;

    @FindBy(xpath = "/html/body/div/div/ul/li[1]/a")
    private WebElement fertelizerCategory;

    @FindBy(xpath = "/html/body/div/div/ul/li[2]/a")
    private WebElement housePlantsCategory;

    @FindBy(xpath = "/html/body/div/div/ul/li[3]/a")
    private WebElement lifeHacksCategory;

    @FindBy(xpath = "/html/body/div/div/ul/li[4]/a")
    private WebElement plantCareCategory;

    @FindBy(xpath = "/html/body/div/div/ul/li[5]/a")
    private WebElement plantDiseaseCategory;

    @FindBy(xpath = "/html/body/div[1]/div/h1")
    private WebElement categoryTitle;

    @FindBy(className = "category_intro_title")
    private WebElement mainTitle;

    public CategoriesPage(WebDriver webDriver) {
        this.webDriver = webDriver;
        initElements(webDriver, this);
    }

    public void click(WebElement link){
        link.click();
    }

    public void getFertelizerCategory() {
        fertelizerCategory.click();
    }

    public void getHousePlantsCategory() {
        housePlantsCategory.click();
    }

    public void getLifeHacksCategory() {
        lifeHacksCategory.click();
    }

    public void getPlantCareCategory() {
        plantCareCategory.click();
    }

    public void getPlantDiseaseCategory() {
        plantDiseaseCategory.click();
    }

    public WebElement getTitle() {
        return categoryTitle;
    }

    public WebElement getMainTitle() {
        return mainTitle;
    }

    public HomePage goToHomePage() {
        return new HomePage(webDriver);
    }

}
